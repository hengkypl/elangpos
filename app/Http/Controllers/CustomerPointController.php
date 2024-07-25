<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\PointMember;
use App\Models\ProdukHadiah;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Illuminate\Support\Facades\DB; // Pastikan import DB facade
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerPointController extends Controller
{
    public function showForm()
    {
        return view('customer_points.form');
    }

    public function showPoints(Request $request)
    {
        $request->validate([
            'memberid' => 'required|exists:tblcustomer,memberid',
        ]);

        $customer = Customer::where('memberid', $request->memberid)->firstOrFail();
        $totalPoints = PointMember::where('customerid', $customer->id)
            ->sum('point_tambah') -
            PointMember::where('customerid', $customer->id)
                ->sum('point_kurang');

        return view('customer_points.show', compact('customer', 'totalPoints'));
    }

    public function redeemForm()
    {
        return view('redeem.form');
    }

    public function showSearchForm()
    {
        return view('redeem.form');
    }

    public function searchByMemberId(Request $request)
    {
        $memberId = $request->input('memberid');
        $customer = Customer::where('memberid', $memberId)->first();

        if (!$customer) {
            return redirect()->route('redeem.showSearchForm')->with('error', 'Customer not found');
        }

        $totalPoints = PointMember::where('customerid', $customer->id)
            ->selectRaw('SUM(point_tambah) - SUM(point_kurang) as total_points')
            ->value('total_points');

        return redirect()->route('redeem.showResults', ['customer' => $customer->id, 'totalPoints' => $totalPoints]);
    }

    public function showResults(Request $request)
    {
        $customer = Customer::find($request->query('customer'));
        $totalPoints = $request->query('totalPoints');

        //$products = ProdukHadiah::where('point', '<=', $totalPoints)->paginate(3);
        $products = Produkhadiah::where('point', '<=', $totalPoints)
            ->orderBy('point', 'asc')
            ->orderBy('namabarang', 'asc')
            ->paginate(5);

        return view('redeem.form', [
            'customer' => $customer,
            'totalPoints' => $totalPoints,
            'products' => $products,
            'memberid' => $customer->memberid // menambahkan memberid untuk pagination
        ]);
    }

    public function searchMember(Request $request)
    {
        $memberid = $request->input('memberid');
        $customer = Customer::where('memberid', $memberid)->first();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        $totalPoints = PointMember::where('customerid', $customer->id)
            ->select(DB::raw('SUM(point_tambah) - SUM(point_kurang) as total_points'))
            ->value('total_points');

        $products = Produkhadiah::where('point', '<=', $totalPoints)->paginate(10);

        return view('redeem.form', compact('customer', 'totalPoints', 'products'));
    }

    public function redeemPoints(Request $request)
    {
        $customerId = $request->input('customerid');
        $quantities = $request->input('quantities');
        $productIds = $request->input('product_ids');
        $totalPoints = $request->input('total_points');

        if (is_null($quantities) || is_null($productIds)) {
            return redirect()->back()->with('error', 'Quantities or product IDs not provided.');
        }

        $totalUsedPoints = 0;
        $redeemedItems = [];

        foreach ($productIds as $index => $productId) {
            $product = Produkhadiah::find($productId);
            if ($product) {
                $quantity = isset($quantities[$index]) ? $quantities[$index] : 0;
                $pointsRequired = $quantity * $product->point;

                if ($totalPoints < $totalUsedPoints + $pointsRequired) {
                    return redirect()->back()->with('error', 'Not enough points for the selected items.');
                }

                $totalUsedPoints += $pointsRequired;
                $redeemedItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'points' => $pointsRequired,
                ];
            }
        }

        if ($totalUsedPoints > $totalPoints) {
            return redirect()->back()->with('error', 'Not enough points to redeem selected items.');
        }

        // Save redeemed points to the database
        foreach ($redeemedItems as $item) {
            PointMember::create([
                'customerid' => $customerId,
                'point_tambah' => 0,
                'point_kurang' => $item['points'],
                'keterangan' => 'Redeem ' . $item['quantity'] . 'x ' . $item['product']->namabarang,
            ]);
        }

        // Print to ESC/POS printer
        $this->printReceipt($customerId, $redeemedItems, $totalUsedPoints);

        // Redirect with success message
        //return redirect()->back()->with('success', 'Items successfully redeemed.');
        
        return redirect()->to('/redeem')->with('success', 'Items successfully redeemed.');
    }

    private function printReceipt($customerId, $redeemedItems, $totalUsedPoints)
    {
        $customer = Customer::find($customerId);

        try {

            $connector = new WindowsPrintConnector("POS-80C");
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $logoPath = storage_path('app/public/fotos/logo2.jpg');
            if (!file_exists($logoPath)) {
                return response()->json(['error' => 'File tidak ditemukan'], 404);
            }
            $logo = EscposImage::load($logoPath, false);
            $printer->bitImage($logo);
            $printer->feed();
            $printer->text("TANDA TERIMA PENUKARAN HADIAH\n");
            $printer->text(date('d-m-Y H:i:s') . "\n");
            $printer->text($customer->nama . "\n");
            $printer->text("Alamat : " . $customer->alamat . "\n");
            $printer->text("--------------------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);

            foreach ($redeemedItems as $item) {
                $printer->text(str::upper($item['quantity'] . "x " . $item['product']->namabarang . " - " . $item['points'] . " poin\n"));

            }
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("--------------------------------------------\n");
            $printer->text("Total Poin yang terpakai : " . $totalUsedPoints . "\n");
            $printer->text("TERIMA KASIH\n");

            $printer->cut();

        } catch (Exception $e) {
            // Handle the exception
            //return redirect()->back()->with('error', 'Printer error: ' . $e->getMessage());
            $printer->text($e->getMessage() . "\n");
            return redirect('/home')->with('error', 'Printer error: ' . $e->getMessage());
        }
        $printer->close();
    }

    public function printLogo()
    {
        try {
            // Ubah sesuai dengan IP dan port printer Anda
            $connector = new WindowsPrintConnector("POS-80C");
            $printer = new Printer($connector);

            // Load gambar dari storage/app/fotos
            $logoPath = storage_path('app/public/fotos/logo2.jpg');
            if (!file_exists($logoPath)) {
                return response()->json(['error' => 'File tidak ditemukan'], 404);
            }

            // Debugging: Pastikan file bisa dibuka
            if (!$image = @imagecreatefromjpeg($logoPath)) {
                return response()->json(['error' => 'Gagal membuka gambar'], 500);
            }

            // Load gambar
            $logo = EscposImage::load($logoPath, false);

            // Cetak gambar menggunakan bitImage
            $printer->bitImage($logo);

            // Potong kertas dan tutup printer
            $printer->cut();
            $printer->close();

            return response()->json(['success' => 'Logo berhasil dicetak!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

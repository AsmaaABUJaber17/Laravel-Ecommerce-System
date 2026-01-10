<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    // عرض جميع الطلبات مع تفاصيل المنتجات التابعة لها
    public function index()
    {
        $orders = Order::with('orderItems.product')->get();
        return view('orders.index', compact('orders'));
    }

    // صفحة شراء منتج معيّن
    public function create(Product $product)
    {
        return view('orders.create', compact('product'));
    }

    // تخزين الطلب في قاعدة البيانات
    public function store(Request $r)
    {
        // نستخدم transaction لضمان تنفيذ العملية كاملة أو التراجع عند الخطأ
        DB::transaction(function () use ($r) {

            // جلب المنتج المطلوب
            $product = Product::findOrFail($r->product_id);

            // إنشاء طلب جديد
            $order = Order::create([
                'user_id' => 1, // مستخدم افتراضي لتفادي مشاكل تسجيل الدخول
                'total' => $product->price * $r->quantity,
                'status' => 'pending'
            ]);

            // إضافة عناصر الطلب
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $r->quantity,
                'unit_price' => $product->price
            ]);

            // تقليل كمية المخزون
            $product->decrement('stock', $r->quantity);
        });

        return redirect()->route('orders.index')
                         ->with('success','Order created');
    }

    // عرض تفاصيل طلب معيّن
    public function show(Order $order)
    {
        $order->load('orderItems.product');
        return view('orders.show', compact('order'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض المنتجات المتوفرة فقط مع pagination
    public function index()
    {
        $products = Product::inStock()->paginate(10);
        return view('products.index', compact('products'));
    }

    // صفحة إضافة منتج جديد
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.create', compact('categories','tags'));
    }

    // تخزين منتج جديد
    public function store(Request $r)
    {
        // التحقق من صحة البيانات
        $data = $r->validate([
            'name'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|integer',
            'category_id'=>'required',
            'tags'=>'array'
        ]);

        // إنشاء المنتج
        $product = Product::create($data);

        // ربط المنتج مع الوسوم (tags)
        $product->tags()->attach($r->tags);

        return redirect()->route('products.index');
    }

    // عرض المنتج بصيغة JSON 
    public function show(Product $product)
    {
        return response()->json($product);
    }

    // صفحة تعديل المنتج
    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.edit', compact('product','categories','tags'));
    }

    // تحديث بيانات المنتج
    public function update(Request $r, Product $product)
    {
        $data = $r->validate([
            'name'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|integer',
            'category_id'=>'required',
            'tags'=>'array'
        ]);

        $product->update($data);

        // تحديث الوسوم المرتبطة بالمنتج
        $product->tags()->sync($r->tags);

        return redirect()->route('products.index');
    }

    // حذف المنتج (Soft Delete)
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}

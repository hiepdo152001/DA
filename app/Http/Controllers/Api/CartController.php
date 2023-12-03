<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\orderDetails;
use App\Models\orders;
use App\Models\products;
use App\Services\CartService;
use Session;
use Illuminate\Http\Request;

class CartController extends Controller
{

/**
     * @var CartService
     */
    protected $cartService;
    public function __construct(CartService $cartService){
        $this->cartService =$cartService;
    }

    public function create($id, Request $request)
{
    $user = $this->getCurrentLoggedIn();
    $product = products::with(['sizes' => function ($query) {
      $query->withPivot('quantity');
      }])->find($id);
   //  $quantity = $request->input('quantity');
      $quantity =1;
    $productPrice = $product->price;

    if (!$user) {
        // Người dùng chưa đăng nhập
        $branchId = 1; // Thay thế bằng id chi nhánh mặc định hoặc xử lý tùy theo yêu cầu của bạn

        $cart = $request->session()->get('cart', []);

        $existingProduct = collect($cart)->firstWhere('id', $id);

        if ($existingProduct) {
            $existingProduct['quantity'] += $quantity;
        } else {
            if ($product) {
                $product['quantity'] = $quantity;
                $cart[] = $product;
            }
        }
        $totalPrice = collect($cart)->pluck('price')->sum();
        $request->session()->put('total', $totalPrice);
        $request->session()->put('cart', $cart);

        return response()->json(
         ['cart' => $cart]);
    } else {
        // Người dùng đã đăng nhập
         $order = orders::where('user_id', $user->id)->first();

         // Nếu chưa có đơn hàng, tạo mới
         if (!$order) {
            $order = $user->order()->create([
               'total_amount' => 1,
               'branch_id' => $user->branch_id,
               // Các trường khác theo yêu cầu của bạn
            ]);
         }
        // Kiểm tra xem sản phẩm đã tồn tại trong đơn hàng chưa
        $existingOrderDetail = $order->orderDetails()->where('product_id', $id)->first();

        if ($existingOrderDetail) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng và thành tiền
            $existingOrderDetail->quantity += $quantity;
            $existingOrderDetail->subtotal += $quantity * $productPrice;
            $existingOrderDetail->save();
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm mới vào đơn hàng
            $orderDetail = new orderDetails([
                'product_id' => $id,
                'quantity' => 1,
                'subtotal' => $quantity * $productPrice,
            ]);

            $order->orderDetails()->save($orderDetail);
        }

        // Cập nhật tổng tiền của đơn hàng
        $order->update(['total_amount' => $order->orderDetails()->sum('subtotal')]);
       
        return response()->json(['message'=>'success']);
    }
}


    public function update($id, Request $request){
         $user= $this->getCurrentLoggedIn();
         if(!$user){
            $product = products::with(['sizes' => function ($query) {
               $query->withPivot('quantity');
               }])->find($id);
            $cart = $request->session()->get('cart');
            $amount = $request['value'];
            $key = array_search($id, array_column($cart, 'id'));
            $cart[$key]['quantity'] += $amount;
            $request->session()->put('cart', $cart);
            $totalPrice = collect($cart)->pluck('price')->sum();
            $request->session()->put('total', $totalPrice);
            return response()->json([
               'data'=>$cart
              ],200);
         }
        $cart= $this->cartService->update($id,$request['value'],$user);
        return response()->json([
         'data'=>$cart
        ],200);
     }

     public function delete($id,Request $request){
      $user=$this->getCurrentLoggedIn();
      if(!$user){
         $product = products::with(['sizes' => function ($query) {
            $query->withPivot('quantity');
            }])->find($id);
         $cart = $request->session()->get('cart');
         $key = array_search($id, array_column($cart, 'id'));
         if ($key !== false) {
            // Nếu sản phẩm tồn tại, loại bỏ nó khỏi giỏ hàng
            array_splice($cart, $key, 1);
        }
        $request->session()->put('cart', $cart);
        $totalPrice = collect($cart)->pluck('price')->sum();
        $request->session()->put('total', $totalPrice);
        return response()->json([
         'data'=>$cart
        ],200);
      }
      $cart= $this->cartService->delete($id,$user);
      return response()->json([
       'data'=>$cart
      ],200);
      }

     public function get(Request $request){
      $user=$this->getCurrentLoggedIn();
      if(!$user){
         $cart = $request->session()->get('cart');
         $total = $request->session()->get('total');
         return response()->json([
            'check'=> 'notuser',
            'data'=>$cart,
            'total'=>$total
           ],200);
      }
      
        $cart= $this->cartService->all($user);
        return response()->json([
         'check'=> 'user',
         'data'=>$cart
        ],200);
     }

   }
    
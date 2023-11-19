<?php

if(!function_exists('get_type_products')) {
    function get_type_products($product)
    {
        if($product->discount) {
            return '';
        }

        if(now()->diffInDays($product->created_at) < 7) {
            return 'new-arrivals';
        }

        return 'hot-sales';
    }
}

if(!function_exists('get_image_product')) {
    function get_image_product($image)
    {
        if(!$image) {
            return asset('uploads/default-product.png');
        }
        return asset("uploads/{$image}");
    }
}

if(!function_exists('get_price_sale')) {
    function get_price_sale($discount, $priceOrigin): string
    {
        $priceSale = $priceOrigin - (($discount / 100) * $priceOrigin);
        return number_format($priceSale);
    }
}

if(!function_exists('get_type_payment')) {
    function get_type_payment($status) {
        switch ($status) {
            case 1:
                return ['class' => 'info', 'message' => 'cod'];
            case 2:
                return ['class' => 'success', 'message' => 'online'];
            default:
                return  ['class' => 'secondary', 'message' => 'NaN'];
        }
    }
}

if(!function_exists('get_status')) {
    function get_status($status) {
        switch ($status) {
            case 0:
                return "<span class='text-info'>Đang giao</span>";
            case 1:
                return "<span class='text-info'>Đã giao</span>";
            default:
                return  'Lỗi';
        }
    }
}



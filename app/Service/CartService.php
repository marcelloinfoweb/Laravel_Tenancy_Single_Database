<?php

namespace App\Service;

use Illuminate\Session\SessionManager as Session;

class CartService
{
    const CART_KEY = 'cart';

    public function __construct(private Session $session)
    {

    }

    public function all()
    {
        $items = $this->session->get(self::CART_KEY);

        return ! $items ? [] : $items;
    }

    public function add($item)
    {
        if ($this->session->has(self::CART_KEY)) {

            if ($this->itemExistInCart($item)) {
                throw new \Exception('Product Already Exists in Car!');
            }

            $this->session->push(self::CART_KEY, $item);

        } else {
            $this->session->put(self::CART_KEY, [$item]);
        }
    }

    public function remove($item)
    {
        $items = $this->session->get(self::CART_KEY);

        $items = array_filter($items, function ($line) use ($item) {
            return $line['slug'] != $item;
        });

        $this->session->put(self::CART_KEY, $items);
    }

    public function clear()
    {
        $this->session->forget([self::CART_KEY, 'shipping_value']);
    }

    public function itemExistInCart($item)
    {
        $items = $this->session->get(self::CART_KEY);

        $somethingSlugsInCart = array_column($items, 'slug');

        return in_array($item['slug'], $somethingSlugsInCart);
    }
}

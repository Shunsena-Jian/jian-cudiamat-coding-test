<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function retrieveOwnedProducts($email);
    public function addProduct($request, $email);
    public function viewProductDetails($request);
    public function editProduct($request);
    public function deleteProduct($request);
}

?>

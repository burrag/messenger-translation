<?php declare(strict_types = 1);

namespace App\Domain\Product\Repository;

use App\Domain\Product\Entity\ProductWeb;

interface ProductWebRepository
{

    public function save(ProductWeb $productWeb);
}

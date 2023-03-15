<?php declare(strict_types = 1);

namespace App\Domain\Translation;

enum ResultAction: string
{
    case none = 'none';
    case updateProperty = 'updateProperty';

}

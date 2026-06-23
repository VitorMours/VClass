<?php 
declare(strict_types=1);

namespace App\Enums;


enum UserStatus : string {
    case ATIVO = "ativo";
    case DESATIVO = "desativo";
    case SUSPENSO = "suspenso";
}

?>
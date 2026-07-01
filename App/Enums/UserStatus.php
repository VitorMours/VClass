<?php 
declare(strict_types=1);

namespace App\Enums;

/**
 * Enumerador responsavel por definir os status que um usuario pode permanecer
 */
enum UserStatus : string {
    case ATIVO = "ativo";
    case DESATIVO = "desativo";
    case SUSPENSO = "suspenso";
}

?>
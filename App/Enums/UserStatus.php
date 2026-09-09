<?php 
declare(strict_types=1);

namespace App\Enums;

/**
 * Enumerador responsavel por definir os status que um usuario pode permanecer
 * dentro do banco de dados, e consequentemente quais tipos de ações ele 
 * pode tomar dentro do sistema, com base em seu status
 * @property string $ATIVO: Acesso normal ao sistema, podendo utilizar as features presentes
 * @property string $DESATIVADO: Conta desativada, sem acesso ao sistema
 * @property string $SUSPENSO: Punição temporária, posterior a determinado tempo, 
 * seu status volta a ser ativo
 */
enum UserStatus : string {
    case ATIVO = "ativo";
    case DESATIVO = "desativo";
    case SUSPENSO = "suspenso";
}

?>
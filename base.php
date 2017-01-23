<?php
/**
 * Funções Básicas.
 * <br/>
 * Esta Biblioteca foi criada com o intuito de facilitar a vida de programadores que estão iniciando com
 * desenvolvimento em php, mas ajudará também desenvolvedores mais experientes pela forma que foi escrita
 * e documentada.<br/>
 *
 * Esta versão está com mais recursos, e tem uma parte focada para quem está começando a Programar Orientado
 * a Objetos.
 *
 * @package   waFunctions
 * @name      Funções Básicas
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @copyright 2007-2008 (c) - {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPL
 * @link      http://www.walkeralencar.com/
 * @link      http://code.google.com/p/sniphpets
 * @version   2.0 beta UTF-8
 */

/**
 * Retorna nome do arquivo da página atual.
 * <br/>
 * Exemplo de uso:
 * <code>
 * <a href="<?php echo Page(); ?>?id=1">link 1</a>
 * </code>
 * Retorno:
 * <code>
 * <a href="projeto.php?id=1">link 1</a>
 * </code>
 * @return string
 */
function Page()
{
    return basename( $_SERVER[ 'PHP_SELF' ] );
}

/**
 * Verifica se existe sessão e retorna nome do arquivo da página atual com SID(Id da Sessão) se a sessão existir.
 * <br/>
 * Recomendada quando se trabalha com session_autostart desativado, ou sem cookies.<br/>
 *
 * Exemplo de uso:
 *  <code><a href="<?php echo SIDPage(); ?>&amp;id=1">link 1</a></code>
 *
 * @return string
 */
function SIDPage()
{
    $tmp = session_id();
    if ( empty( $tmp ) ) {
        throw new Exception( "Erro ao solicitar o SID, a sessao precisa ser inicializada com session_start()." );
    }
    return Page() . "?" . strip_tags( SID );
}

/**
 * Checa a variavel enviada pelo metodo POST.
 * A Checagem consiste em verificar se a variável existe e não é vazia, ou se é igual a 0(Zero)
 *
 * @param string  $pVarName
 *    Nome da variavel que deseja checar.
 * @return bool
 */
function checkPOST( $pVarName )
{
    if ( count( $_POST ) == 0 ) {
        return false;
    }
    return (
        isset( $_POST[ "{$pVarName}" ] )
        and ( !empty( $_POST[ "{$pVarName}" ] )
        or  ( $_POST[ "{$pVarName}" ] == '0' ) )
    );
}

/**
 * Checa a variavel enviada pelo metodo GET.
 * A Checagem consiste em verificar se a variável existe e não é vazia, ou se é igual a 0(Zero)
 *
 * @param string $pVarName
 *    Nome da variavel que deseja checar.
 * @return bool
 */
function checkGET( $pVarName )
{
    if ( count( $_GET ) == 0 ) {
        return false;
    }
    return (
        isset( $_GET[ "{$pVarName}" ] )
        and ( !empty( $_GET[ "{$pVarName}" ] )
        or ( $_GET[ "{$pVarName}" ] == '0' ) )
    );
}

/**
 * Checa a variavel de UPLOADs enviados.
 * A Checagem consiste em verificar se a variável existe e o 'tmp_name' não é vazio
 *
 * @param string $pVarName
 *    Nome da variavel que deseja checar.
 * @return  bool
 */
function checkFiles( $pVarName )
{
    if ( count( $_FILES ) == 0 ) {
        return false;
    }
    return (
        isset( $_FILES[ "{$pVarName}" ] )
        and !empty( $_FILES[ "{$pVarName}" ][ 'tmp_name' ] )
    );
}

/**
 * Remove acento dos caracteres acentuados na string.
 * <br/>
 * Recomendação: para renomear nome de arquivos dos uploads, etc.<br/>
 *
 * Modo de Uso: 
 * <code>
 * <?php
 * $sFileName = removerAcentos('negociação.xml'); // retorna: 'negociacao.xml'
 * ?>
 * </code>
 *
 * @param string $pString
 *    Texto com caracteres acentuados.
 * @return string
 */
function removeAcentos( $pString )
{
    $aMatches = array(
        "A" => "/[" . chr( 194 ) . chr( 192 ) . chr( 193 ) . chr( 196 ) . chr( 195 ) . "]/",
        "E" => "/[" . chr( 202 ) . chr( 200 ) . chr( 201 ) . chr( 203 ) . "]/",
        "I" => "/[" . chr( 206 ) . chr( 205 ) . chr( 204 ) . chr( 207 ) . "]/",
        "O" => "/[" . chr( 212 ) . chr( 213 ) . chr( 210 ) . chr( 211 ) . chr( 214 ) . "]/",
        "U" => "/[" . chr( 219 ) . chr( 217 ) . chr( 218 ) . chr( 220 ) . "]/",
        "C" => "/[" . chr( 199 ) . "]/",
        "N" => "/[" . chr( 209 ) . "]/",
        "a" => "/[" . chr( 226 ) . chr( 227 ) . chr( 224 ) . chr( 225 ) . chr( 228 ) . "]/",
        "e" => "/[" . chr( 234 ) . chr( 232 ) . chr( 233 ) . chr( 235 ) . "]/",
        "i" => "/[" . chr( 238 ) . chr( 237 ) . chr( 236 ) . chr( 239 ) . "]/",
        "o" => "/[" . chr( 244 ) . chr( 245 ) . chr( 242 ) . chr( 243 ) . chr( 246 ) . "]/",
        "u" => "/[" . chr( 251 ) . chr( 250 ) . chr( 249 ) . chr( 252 ) . "]/",
        "c" => "/[" . chr( 231 ) . "]/",
        "n" => "/[" . chr( 241 ) . "]/"
    );

    return preg_replace( array_values( $aMatches ), array_keys( $aMatches ), $pString );
}
?>
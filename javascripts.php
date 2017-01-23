<?php
/**
 * Funções para javascript.
 * <br/>
 * Facilita o uso de javascript no meio do código php, seja montando um alert, redirect, ou back.
 *
 * @package   waFunctions
 * @name      Funções para Javascript
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @copyright 2007-2008 (c) - {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPL
 * @link      http://www.walkeralencar.com/
 * @link      http://code.google.com/p/sniphpets
 * @version   2.0 beta UTF-8
 */
/**
 * Escreve o javascript de redirecionamento para voltar à página anterior;
 *
 * @param bool $onScript
 *    Se true, escreve somente a linha de redirecionamento, se falso, escreve o corpo do javascript.
 */
function jsBack($onScript = false)
{
    $tmpRedirect = "\thistory.back();\n";

    if ( $onScript ) {
        echo $tmpRedirect;
    } else {
        echo "<script language=\"javascript\">\n{$tmpRedirect}</script>";
        exit();
    }
}

/**
 * Escreve o javascript de redirecionamento para uma página.
 *
 * @param string $redirectToPage
 *    Redirecionar para o link.
 * @param bool $needParent
 *    Se informado adiciona [parent.] só será necessário caso esteja usando iFrame.
 * @param bool $onScript
 *    Se true, apenas escreve somente a linha de redirecionamento, se falso, escreve o corpo do javascript.
 */
function jsRedirect( $redirectToPage, $needParent = false, $onScript = false )
{
    $tmpRedirect = "\t" . ( ( $needParent ) ? "parent." : "" ) . "document.location.href='{$redirectToPage}';\n";

    if ( $onScript ) {
        echo $tmpRedirect;
    } else {
        echo "<script language=\"javascript\">\n{$tmpRedirect}</script>";
        exit();
    }
}

/**
 * Escreve o javascript para uma mensagem de alerta.
 * 
 * Podendo escrever um history.back() ou redirecionar para uma página depois de clicado OK.
 *
 * @param string $message
 *    String contendo a Mensagem.
 * @param string $redirectToPage
 *    Se informado redireciona a página após clicar OK no Alerta.
 *    Se passar como valor: 'back', volta para pagina anterior após clicar OK no Alerta
 * @param bool   $needParent
 *    Se informado adiciona [parent.] só será necessário caso esteja usando iFrame.
 */
function jsAlert( $message, $redirectToPage = NULL, $needParent = false )
{
    $bExit = false;
    echo "<script language=\"javascript\">\n";
    echo "\talert('{$message}');\n";
    if ( $redirectToPage ) {
        $bExit = true;
        if ( $redirectToPage === 'back' ) {
            jsBack( true );
        } else {
            jsRedirect( $redirectToPage, $needParent, true );
        }
    }
    echo "</script>";
    if ( $bExit ) {
        exit();
    }
}
?>
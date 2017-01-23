<?php
/**
 * Funções para Classes.
 * <br />
 * Voltado para quem estiver começando a trabalhar com classes, idealiza o conceito de estrutura de pastas
 * direcionando as classes para uma pasta especifica, facilitando o acesso aos arquivos.
 *
 * @package   waFunctions
 * @name      Funções para Classes
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @copyright 2007-2008 (c) - {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPL
 * @link      http://www.walkeralencar.com/
 * @link      http://code.google.com/p/sniphpets
 * @version   2.0 beta UTF-8
 */

/**
 * Diretório raiz do projeto com base no local do arquivo: 'waFunctions_v2.php'.
 * <br />
 * 1. Se o arquivo estiver na raiz do projeto, use o código "1".
 * 2. Se o arquivo estiver dentro de alguma pasta no projeto, use o código "2". ex.: libs.
 * 3. Se preferir defina manualmente, use como exemplo o código "3".
 * <br />
 * 
 * 1.define( 'PATH_ROOT', basename( $_SERVER[ 'SCRIPT_NAME' ] ) . DIRECTORY_SEPARATOR );<br/>
 * 2.define( 'PATH_ROOT', basename( basename( $_SERVER[ 'SCRIPT_NAME' ] ) ) . DIRECTORY_SEPARATOR );<br/>
 * 3.define( 'PATH_ROOT', '/projeto' . DIRECTORY_SEPARATOR )
 */
define( 'PATH_ROOT', basename( $_SERVER[ 'SCRIPT_NAME' ] ) . DIRECTORY_SEPARATOR );

/**
 * Diretório onde se encontra as Classes genéricas
 */
define( 'PATH_INCLUDE', PATH_ROOT . 'libs' . DIRECTORY_SEPARATOR );

/**
 * Função de Auto-carregamento de classes.
 * <br />
 * Esta função é automaticamente chamada no caso de você tentar usar uma classe que ainda não foi definida.
 * Ao chamar essa função o 'scripting engine' tem uma última chance para carregar a classe antes que o PHP
 * falhe com uma mensagem de erro. Suportada apenas para PHP 5 ou superior.
 * <br />
 * Com esse recurso diminui drásticamente o uso de includes e requires dentro dos arquivos.
 *
 * @param string $pClassName
 *    Nome da classe
 */
function __autoload( $pClassName )
{
    require_once ( PATH_INCLUDE . $pClassName . '.class.php' );
}
?>
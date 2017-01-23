<?php
/**
 * Funções para Módulos.
 * <br/>
 * Voltado para quem estiver começando a trabalhar com MVC, idealiza o conceito de estrutura de pastas
 * direcionando os módulos para uma pasta especifica, facilitando o acesso aos arquivos.
 *
 * @package   waFunctions
 * @name      Funções para Módulos
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @copyright 2007-2008 (c) - {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPL
 * @link      http://www.walkeralencar.com/
 * @link      http://code.google.com/p/sniphpets
 * @version   2.0 beta UTF-8
 */

/**
 * Diretório onde se encontra os Módulos.
 */
define( 'PATH_MODULES', PATH_ROOT . 'modules' . DIRECTORY_SEPARATOR );

/**
 * Retorna o caminho do Módulo.
 * <br/>
 * Será melhor utilizada se trabalhar com projetos tratando cada módulo em uma pasta, para
 * quem está pensando em estudar MVC, será de boa ajuda, para o início dos estudos.
 * <br/>
 * Partindo da estrutura de pastas:
 * <code>
 * Clientes....: /projeto/modules/cliente
 * Fornecedores: /projeto/modules/fornecedor
 * Produtos....: /projeto/modules/produto
 * </code>
 * Ex.:
 * <code>
 * <?php
 * //o inModule('cliente') retorna: '/projeto/modules/cliente/'
 * include_once ( inModule( 'cliente' ) . 'view/list.php' );
 * ?>
 * </code>
 *
 * @param string $pModuleName
 *    Nome do Módulo
 */
function inModule( $pModuleName )
{
  return PATH_MODULE . "{$pModuleName}" . DIRECTORY_SEPARATOR;
}
?>
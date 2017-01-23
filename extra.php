<?php
/**
 * Funções Extras.
 * <br/>
 * Funções com usos diversos, ainda não categorizadas
 *
 * @package   waFunctions
 * @name      Funções Extras
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @copyright 2007-2008 (c) - {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPL
 * @link      http://www.walkeralencar.com/
 * @link      http://code.google.com/p/sniphpets
 * @version   2.0 beta UTF-8
 */

/**
 * Gera paginacao, de lista de registros de tabela por exemplo.
 * <br/>
 * Recomenda-se o uso deste CSS( {@link http://www.walkeralencar.com/resources/css/paginacao.css paginacao.css} )
 * na página. Você pode personalizá-lo como bem entender.
 * <br/>
 * Modo de uso:
 * <code>
 * <?php
 * echo geraPaginacao('clientes.php', 6, 4, (checkGET('np')?$_GET['np']:1) );
 * ?>
 * </code>
 * Resultado:
 * <code>
 *   <div class="paginacao">
 *       <ul>
 *           <li><a href="clientes.php?np=1" class="marcado">1</a></li>
 *           <li><a href="clientes.php?np=2" >2</a></li>
 *       </ul>
 *   </div>
 * </code>
 *
 * @param string $pURL
 *    Endereco do link a ser gerado.
 * @param int $pTotal
 *    Qtd total de Registros.
 * @param int $pLimite
 *    Limite de Registros por página.
 * @param int $pCurrentPage
 *    Página Atual, gerado o valor em $_GET['np'].
 * @return string
 */
function geraPaginacao( $pURL, $pTotal, $pLimite, $pCurrentPage = 1 )
{
    //Máximo de Páginas
    $iMax = ceil( $pTotal / $pLimite );

    //Verifica se a url já possui o char ?, para gerar entre (? e &) antes do 'np'
    $pURL .= ( ( strpos( $pURL, '?' ) === false ) ? "?" : "&amp;" );

    $tmpStr = "\n<div id=\"paginacao\">\n\t<ul>";

    for ( $iCounter = 1; $iCounter <= $iMax; $iCounter++ ) {
        $tmpMark = ( ( $iCounter == $pCurrentPage ) ? "class=\"marcado\"" : "" );
        $tmpStr .= "\n\t\t<li><a href=\"{$pURL}np={$iCounter}\" {$tmpMark}>{$iCounter}</a></li>";
    }

    $tmpStr .= "\n\t</ul>\n</div>";

    return $tmpStr;
}

/**
 * Gera os options, com base em um array informado e em conformidade com o W3C - XHTML 1.0
 *
 * <code>
 * <?php
 * $aTeste = array(1 => 'um',2 => 'dois',5 => 'cinco');
 * echo "<select name=\"teste\">".ArrayToOption($aTeste,2)."</select>";
 * ?>
 * </code>
 * Resultado:
 * <code>
 *  <select name="teste">
 *    <option value="1" >um</option>
 *    <option value="2" selected="selected" >dois</option>
 *    <option value="5" >cinco</option>
 *  </select>
 * </code>
 *
 * @param array $pItem
 *    Lista com as opções em um array.
 * @param mixed $pAtual
 *    Key do item que deve estar marcado com: selected.
 * @return string
 */
function ArrayToOption( $pItem, $pAtual = 0 )
{
    $tmpStr = null;
    foreach ( $pItem as $id => $texto ) {
        $selected = ( $id == $pAtual ) ? 'selected="selected"' : '';
        $tmpStr .= "\n\t<option value=\"{$id}\" {$selected}>{$texto}</option>";
    }
    return $tmpStr;
}

/**
 * Gera um Select/options, com base em um array informado.
 *
 * <code>
 * <?php
 * $aTeste = array(1 => 'um',2 => 'dois',5 => 'cinco');
 * echo ArrayToSelect($aTeste,'teste',2);
 * ?>
 * </code>
 * Resultado:
 * <code>
 *  <select name="teste" id="teste">
 *    <option value="1" >um</option>
 *    <option value="2" selected="selected" >dois</option>
 *    <option value="5" >cinco</option>
 *  </select>
 * </code>
 *
 * @param array $pItems
 *    Lista com as Opções em um array.
 * @param string $pNome
 *    Nome do elemento <select>
 * @param mixed $pAtual
 *    Key do item que deve estar marcado com: selected.
 * @return string
 */
function ArrayToSelect( $pItems, $pNome, $pAtual )
{
    $arOpt = ArrayToOption( $pItems, $pAtual );
    $tmpStr = "\n<select name=\"{$pNome}\" id=\"{$pNome}\">\n\t{$arOpt}\n</select>";
    return $tmpStr;
}

/**
 * Obtem a lista de Estados do Brasil.
 *
 * @return array
 *    Array contendo as UF como "Keys" e o nome por extenso como "Value"
 */
function listUF(){
    return array(
        "AC" => "Acre",
        "AL" => "Alagoas",
        "AM" => "Amazonas",
        "AP" => "Amapá",
        "BA" => "Bahia",
        "CE" => "Ceará",
        "DF" => "Distrito Federal",
        "ES" => "Espírito Santo",
        "GO" => "Goiás",
        "MA" => "Maranhão",
        "MG" => "Minas Gerais",
        "MS" => "Mato Grosso do Sul",
        "MT" => "Mato Grosso",
        "PA" => "Pará",
        "PB" => "Paraíba",
        "PE" => "Pernambuco",
        "PI" => "Piauí",
        "PR" => "Paraná",
        "RJ" => "Rio de Janeiro",
        "RN" => "Rio Grande do Norte",
        "RO" => "Rondônia",
        "RR" => "Roraima",
        "RS" => "Rio Grande do Sul",
        "SC" => "Santa Catarina",
        "SE" => "Sergipe",
        "SP" => "São Paulo",
        "TO" => "Tocantins",
        "EX" => "Exterior"
    );
}

/**
 * Cria um Select/Option de UF.
 *
 * @param string $pAtual
 *    UF do Estado que deverá ficar como selecionado.
 * @param string $pName
 *    Nome do elemento <select>
 * @return string
 *    String contendo <select><option>...
 */
function selectUF( $pAtual, $pName = 'uf' )
{
    if ( !in_array( $pAtual, listUF() ) ) {
        $pAtual = "--";
    }
    return ArrayToSelect( listUF(), $pName, $pAtual );
}

/**
 * Cria os Option de UF.
 *
 * @param string $pAtual
 *    UF do Estado que deverá ficar como selecionado.
 * @return string
 *    String contendo <option>...
 */
function optionsUF( $pAtual )
{
    if ( !in_array( $pAtual, listUF() ) ) {
        $pAtual = "--";
    }
    return ArrayToOption( listUF(), $pAtual );
}

/**
 * Varre todos os GET/POST/REQUEST, eliminando as tags de HTML e PHP, e aplicando o escape "\" para caracteres especiais.
 * <br/>
 * Obs.: é apenas uma precaução básica mas já ajuda muito.
 * <br/>
 * Recomendação: usar no antes de concatenar os $_GET/$_POST/$_REQUEST nas strings de SQL.
 * <br/>
 * Modo de Uso: 
 * <code>
 * clearSqlInject();
 * </code>
 */
function clearSqlInject()
{
    if ( !get_magic_quotes_gpc() ) {
        if ( count( $_GET ) > 0 ) {
            foreach ( $_GET as $k => $v ) {
                $_GET[ $k ] = mysql_real_escape_string( strip_tags( $v ) );
            }
        }
        if ( count( $_POST ) > 0 ) {
            foreach ( $_POST as $k => $v ) {
                $_POST[ $k ] = mysql_real_escape_string( strip_tags( $v ) );
            }
        }
        if ( count( $_REQUEST ) > 0 ) {
            foreach ( $_REQUEST as $k => $v ) {
                $_REQUEST[ $k ] = mysql_real_escape_string( strip_tags( $v ) );
            }
        }
    }
}
?>

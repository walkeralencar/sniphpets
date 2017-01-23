<?php
/**
 * Funções para Datas.
 * <br/>
 * Voltada para auxilio de conversoes de datas, e algumas manipulacoes de dados em formulário.
 *
 * @package   waFunctions
 * @name      Funções para Datas
 * @author    {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @copyright 2007-2008 (c) - {@link http://www.walkeralencar.com Walker de Alencar} <contato@walkeralencar.com>
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPL
 * @link      http://www.walkeralencar.com/
 * @link      http://code.google.com/p/sniphpets
 * @version   2.0 beta UTF-8
 */

/**
 * Converte datas no formato: AAAA-MM-DD para DD/MM/AAAA. Porém, não faz validações.
 *
 * @param string $pDate
 *    string com a Data no formato: AAAA-MM-DD.
 * @return string
 *    string com a Data no formato: DD/MM/AAAA.
 */
function DateUsToBr( $pDate )
{
    return date( 'd/m/Y', strtotime( $pDate ) );
}

/**
 * Converte datas no formato: DD/MM/AAAA para AAAA-MM-DD. Porém, não faz validações.
 * <br/>
 * Se for informada uma string em branco retorna: '0000-00-00'
 *
 * @param string $pDate
 *    string com a Data no formato: DD/MM/AAAA.
 * @return string
 *    string com a Data no formato: AAAA-MM-DD.
 */
function DateBrToUs( $pDate )
{
  $tmpDate = implode( '-', array_reverse( explode( '/', $pDate ) ) );
  return ( in_array( $tmpDate, array( '--' , '' ) ) ? '0000-00-00' : $tmpDate );
}

/**
 * Nome do Mês informado em português.
 * <br/>
 * Ex.:
 * <code>
 * echo getMes(9); // retorna: Setembro
 * </code>
 *
 * @param int $mes
 *    Numero representando o Mês que se deseja.
 *    Valores entre: 1 e 12.
 * @return string
 *    Nome do Mês em português.
 */
function strMes( $mes )
{
    $aMes = array(
        1 => 'Janeiro',
        'Fevereiro',
        'Mar&ccedil;o',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    );
    return $aMes[ (int) $mes ];
}
/**
 * Gera os Selects de Dia, Mês e Ano. 
 * Um ao lado do outro, e deixa selecionado a data que for informada, desde que essa data seja informada no formato 
 * americano: AAAA-MM-DD.
 * <br/>
 * Ex:
 * <code>
 *  <?php echo chooseDate('dtNascimento'); ?> //em HTML
 * </code>
 * Ao submeter o formulário tratar como um array, onde:
 * 1. $var['d'] - contém o dia.
 * 2. $var['m'] - contém o Mês.
 * 3. $var['y'] - contém o Ano.
 * <br/>
 * <code>
 * <?php
 * $dtNasc = $_POST['dtNascimento'];
 * if ( ! checkdate( $dtNasc[ 'm' ], $dtNasc[ 'd' ], $dtNasc[ 'y' ] ) ) {
 *     echo printf('Data de Nascimento[%s/%s/%s] é inválida!',$dtNasc[ 'd' ],$dtNasc[ 'm' ],$dtNasc[ 'y' ]);
 * }
 * ?>
 * </code>
 *
 * @param string $pName
 *    Nome do elemento <select>
 * @param string $timestamp
 *    Data em formato americano: YYYY-MM-DD
 * @return string
 */
function chooseDate( $pName, $timestamp = "" )
{
    if ( $timestamp == "" ) {
        $timestamp = time();
    }

    $out = "<select name=\"{$pName}[d]\" style=\"width: 45px;\">";
    for ( $i = 1; $i <= 31; $i++ ) {
        $tmp = ( $i == date( 'j', $timestamp ) ? ' selected="selected"' : ''  );
        $out .= '<option value="' . $i . '" ' . $tmp  . ' >' . $i . '</option>';
    }
    $out .= "</select>\n<select name=\"{$pName}[m]\" style=\"width: 90px;\">";

    for ( $i = 1; $i <= 12; $i++ ) {
        $tmp = ( $i == date( 'm', $timestamp ) ? ' selected="selected"' : ''  );
        $out .= '<option value="' . $i . '" ' . $tmp  . ' >' . strMes($i) . '</option>';
    }
    $out .= "</select>\n<select name=\"{$pName}[y]\" style=\"width: 60px;\">";
    for ( $i = date( 'Y' ) + 1; $i >= 1970; $i-- ) {
        $tmp = ( $i == date( 'Y', $timestamp ) ? ' selected="selected"' : ''  );
        $out .= '<option value="' . $i . '" ' . $tmp  . ' >' . $i . '</option>';
    }
    $out .= "</select>";
    return $out;
}
?>
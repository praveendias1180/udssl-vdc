<?php

/**
 * Plugin Name: UDSSL Voltage Drop Calculator
 */

/**
 * Ennqueue Scripts and Styles.
 */
function enqueue_udssl_vdc_scripts()
{
    wp_enqueue_script('udssl_vdc_js', plugins_url('udssl-vdc.js', __FILE__), array(), false, true);
    wp_enqueue_style('udssl_vdc_style', plugins_url('udssl-vdc.css', __FILE__), array(), false);
}
add_action('wp_enqueue_scripts', 'enqueue_udssl_vdc_scripts');

/**
 * use [udssl_vdc] shortcode
 */
add_shortcode('udssl_vdc', 'voltage_drop_calculator');

/**
 * HTML for the VDC.
 */
function voltage_drop_calculator($atts)
{
    ob_start(); ?>

<form name="calcform" autocomplete="off">
    <table class="calc2">
        <tbody>
            <tr>
                <td>Wire type:</td>
                <td>
                    <select name="type" onchange="OnIResChange()" style="width:180px" autofocus="">
                        <option>-- select --</option>
                        <option selected="">Copper</option>
                        <option>Aluminum</option>
                        <option>Carbon steel</option>
                        <option>Electrical steel</option>
                        <option>Gold</option>
                        <option>Nichrome</option>
                        <option>Nickel</option>
                        <option>Silver</option>
                    </select>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Resistivity:</td>
                <td class="math"><input type="text" name="res" value="1.72e-8" class="intext" onchange="OnResChange()">
                </td>
                <td class="mathsymbol">Ω·m</td>
            </tr>
            <tr>
                <td>Wire diameter size:</td>
                <td class="math"><input type="number" min="0 step=" any"="" name="s" value="18" class="intext"></td>
                <td><select name="ssel">
                        <option>AWG</option>
                        <option>inch</option>
                        <option>mm</option>
                    </select></td>
            </tr>
            <tr>
                <td>Wire/cable length (one way):</td>
                <td class="math"><input type="number" min="0" step="any" name="l" value="10" class="intext"></td>
                <td><select name="lsel">
                        <option>feet</option>
                        <option>meters</option>
                    </select></td>
            </tr>
            <tr>
                <td>Current type:</td>
                <td colspan="2"><select name="phase" style="width:180px">
                        <option>DC</option>
                        <option selected="">AC - Single phase</option>
                        <option>AC - Three phase</option>
                    </select></td>
            </tr>
            <tr>
                <td>Voltage in volts:</td>
                <td class="math"><input type="number" step="any" name="v" value="120" class="intext"></td>
                <td class="mathsymbol">V</td>
            </tr>
            <tr>
                <td>Current in amps:</td>
                <td class="math"><input type="number" step="any" name="i" value="1" class="intext"></td>
                <td class="mathsymbol">A</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2"><input onclick="OnCalc()" type="button" value="Calculate" class="btn"> <input
                        type="button" value="Reset" class="btn"></td>
            </tr>
            <tr>
                <td>Voltage drop in volts:</td>
                <td class="math"><input type="text" name="vd" class="outtext" readonly=""></td>
                <td class="mathsymbol">V</td>
            </tr>
            <tr>
                <td>Percentage of voltage drop:</td>
                <td class="math"><input type="text" name="vdp" class="outtext" readonly=""></td>
                <td class="mathsymbol">%</td>
            </tr>
            <tr>
                <td>Wire resistance:</td>
                <td class="math"><input type="text" name="r" class="outtext" readonly=""></td>
                <td class="mathsymbol">Ω</td>
            </tr>
        </tbody>
    </table>
</form>

<?php
    return ob_get_clean();
}
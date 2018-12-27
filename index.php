<!DOCTYPE html>
<html>
<head>
	<title>Conexión</title>
    
</head>
<body>

<?php

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
AQUI ABAJO!!! la rura LO ENCUENTRAS DENTRO DE ANTA.PSE.PE
INGRESANDO CON LA CUENTA DEL CLIENTE EL VALOR LO REMPLAZARAS DENTRO DE LAS COMILLAS 
↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$ruta = "https://www.pse.pe/api/v1/f99e617b297f4158b35d00edc7586f5bf05aa947a45141e3a1db413b80ba5990";
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
AQUI ABAJO!!!!!!  EL CODIGO TOKEN LO ENCUENTRAS DENTRO DE ANTA.PSE.PE
INGRESANDO CON LA CUENTA DEL CLIENTE EL VALOR LO REMPLAZARAS DENTRO DE LAS COMILLAS 
↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$token ="eyJhbGciOiJIUzI1NiJ9.ImU3ZTY4ZGIzODg1ZTQyNTk4NjM1NGYzZTYyOWJiZmQ1NTk0ZjEyMWEzNDZmNGQ3YWE4MmJiMmI5NzFlNTlhNzgi.ZSqcDKeWAU77I8GvQ185BJQGF93EkJuzfBxqda8pBwk"; 
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
nombres de las bases de datos, en caso sean 2 se utilizan los dos valores 
en caso sea solo una es mas facil pues repites el valor de anta en ambos
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$db1="antasolutions";
$db2="antasolutions";


$conexion =  pg_connect("host=localhost dbname=	anta user=anta password=anta")
    or die('No se ha podido conectar: ' . pg_last_error());

    function existe($tabla,$invoice_id)
    {$conexion=conectar_PostgreSQL();
    	$sql="select * from ".$tabla." where invoice_id=$invoice_id";
    	 $result=pg_query( $conexion, $sql);
    	 return pg_num_rows($result);
    	  }

    	  
    function maxi($tabla)
    {
    	$conexion=conectar_PostgreSQL();
    	$sql=" select max(id) as id from ".$tabla." ";
    	
    	 $result=pg_query( $conexion, $sql);
    	 $valor=pg_fetch_result($result,0, 0);
    	 return $valor;
    }

function conectar_PostgreSQL()
    {
         $conexion =  pg_connect("host=localhost dbname=anta user=anta password=anta")
    or die('No se ha podido conectar: ' . pg_last_error());

        return $conexion;
    }

    function conecta_cevi()
    {         $conexion =  pg_connect("host=localhost dbname=anta user=anta password=anta")
    or die('No se ha podido conectar: ' . pg_last_error());

        return $conexion;
}

    function insertarcontador( $tabla,$id,$invoice_id)
    {$conexion=conectar_PostgreSQL();
        $sql = "INSERT INTO ".$tabla." VALUES (".$id.",".$invoice_id.")";
        // Ejecutamos la consulta (se devolverá true o false):
         return pg_query( $conexion, $sql );
    }
    function insertarlink( $tabla,$id,$link)
    {$conexion=conectar_PostgreSQL();
    	
        $sql = "UPDATE ".$tabla." set link='".$link."' where id =".$id."";
        // Ejecutamos la consulta (se devolverá true o false):
         return pg_query( $conexion, $sql );
    }



    function eliminarcontador( $tabla,$invoice_id)
    {$conexion=conectar_PostgreSQL();
        $sql = "DELETE FROM  ".$tabla." WHERE invoice_id= (".$invoice_id.")";
        // Ejecutamos la consulta (se devolverá true o false):
         return pg_query( $conexion, $sql );
    }
    function obtenerprecio($product_id)
    {
		$conexion=conectar_PostgreSQL();
		
    	$sql=" select list_price from product_template where id=".$product_id."";
    	 	 $result=pg_query( $conexion, $sql);
    	 $valor=pg_fetch_result($result,0, 0);
    	 return $valor;
    }
    
sleep(9);


// Conectando y seleccionado la base de datos  
$dbconn = pg_connect("host=localhost dbname=anta user=anta password=anta")
    or die('No se ha podido conectar: ' . pg_last_error());

// Realizando una consulta SQL
$query = 'select Factura.id,factura.name,factura.date_invoice,factura.number,factura.amount_untaxed,factura.amount_tax,factura.amount_total,cliente.vat,cliente.display_name,cliente.email, cliente.phone,cliente.street,cliente.city from account_invoice AS FACTURA JOIN RES_PARTNER AS CLIENTE ON FACTURA.PARTNER_ID=CLIENTE.ID where factura.id=(SELECT MAX(ID) AS ID FROM ACCOUNT_INVOICE)';
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

// Imprimiendo los resultados en HTML
$arreglo;
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
$i=0;
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
    	
echo "$i";
    	$arreglo[$i]="$col_value";
    	echo "# id: \t\t$col_value <br>";
        
       
        $i++;
    }
    echo "\t</tr>\n";
}
echo "</table>\n";



$arreglopro;
$query = 'select producto.product_tmpl_id,producto.id,pedido.name,pedido.quantity,pedido.price_unit,pedido.price_total,pedido.discount from account_invoice_line AS PEDIDO JOIN product_product AS producto ON pedido.product_id=producto.ID  where pedido.invoice_id=(SELECT MAX(ID) AS ID FROM ACCOUNT_INVOICE)';
$linea = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

sleep(1);
// Imprimiendo los resultados en HTML
echo "<table>\n";
$i=0;
while ($line = pg_fetch_array($linea, null, PGSQL_ASSOC)) {
$arreglopro[$i]="";
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
    	
        $arreglopro[$i]=$arreglopro[$i]."$col_value"."cadena";
      //  echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
$i++;
}
echo "</table>\n";


// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);
?>

<?php
// Abrir el0 archivo
$arreglo[2] = date("d/m/Y", strtotime($arreglo[2]));
$arreglo[6]=round($arreglo[6]/1.18,2);
$total_igv=round($arreglo[6]*0.18,2);
$archivo = 'cadena.txt';
$total=round($total_igv+$arreglo[6],2);
$abrir = fopen($archivo,'r+');
$contenido = fread($abrir,filesize($archivo));
fclose($abrir);
$numero=explode("/", $arreglo[1]); 
 $arreglo[0]=$arreglo[0]+10000000;
// Guardar Archivo
$abrir = fopen($archivo,'w');
fwrite($abrir,"operacion|generar_comprobante|"."\r\n");
if(strlen($arreglo[7])==11)
{//aqui empieza el grbado
	$tabla="efactura";
	if(existe($tabla,$arreglo[0])==0)
{$result=maxi($tabla);
	$conta=$result+1;
	insertarcontador($tabla,$conta,$arreglo[0]);
}
else
{echo "ya esta registrado";
	exit();
}
//aqui termina

	fwrite($abrir,"tipo_de_comprobante|1|"."\r\n");
fwrite($abrir,"serie|F001|"."\r\n");
fwrite($abrir,"numero|$conta|"."\r\n");
fwrite($abrir,"cliente_tipo_de_documento|6|"."\r\n");



}
else//(strlen($arreglo[7])==8)
{//aqui empieza el grbado
	$tabla="eboleta";
	if(existe($tabla,$arreglo[0])==0)
{$result=maxi($tabla);
	$conta=$result+1;
	insertarcontador($tabla,$conta,$arreglo[0]);
}
else
{echo "ya esta registrado";
	exit();


}
//aqui termina
fwrite($abrir,"tipo_de_comprobante|2|"."\r\n");
fwrite($abrir,"serie|B001|"."\r\n");
fwrite($abrir,"numero|$conta|"."\r\n");
if(strlen($arreglo[7])==8){fwrite($abrir,"cliente_tipo_de_documento|1|"."\r\n");}
else
	{fwrite($abrir,"cliente_tipo_de_documento|-|"."\r\n");}


}

fwrite($abrir,"cliente_numero_de_documento|$arreglo[7]|"."\r\n");
fwrite($abrir,"cliente_denominacion|$arreglo[8]|"."\r\n");
fwrite($abrir,"cliente_direccion|$arreglo[11]|"."\r\n");
fwrite($abrir,"cliente_email|$arreglo[9]|"."\r\n");
fwrite($abrir,"cliente_email_1|$arreglo[9]|"."\r\n");
fwrite($abrir,"cliente_email_1|email@email.com|"."\r\n");
fwrite($abrir,"cliente_email_2|anta.fsheron@gmail.com|"."\r\n");
fwrite($abrir,"fecha_de_emision|$arreglo[2]|"."\r\n");
fwrite($abrir,"moneda|1|"."\r\n");
fwrite($abrir,"tipo_de_cambio||"."\r\n");
fwrite($abrir,"porcentaje_de_igv|18|"."\r\n");
fwrite($abrir,"descuento_global||"."\r\n");
fwrite($abrir,"total_gravada|$arreglo[6]|"."\r\n");
fwrite($abrir,"total_igv|$total_igv|"."\r\n");
fwrite($abrir,"total_gratuita||"."\r\n");
fwrite($abrir,"total_otros_cargos||"."\r\n");
fwrite($abrir,"total|$total|"."\r\n");
fwrite($abrir,"percepcion_tipo||"."\r\n");
fwrite($abrir,"percepcion_base_imponible||"."\r\n");
fwrite($abrir,"total_percepcion||"."\r\n");
fwrite($abrir,"total_incluido_percepcion||"."\r\n");
fwrite($abrir,"detraccion|false|"."\r\n");
fwrite($abrir,"observaciones||"."\r\n");
fwrite($abrir,"documento_que_se_modifica_tipo||"."\r\n");
fwrite($abrir,"documento_que_se_modifica_serie||"."\r\n");
fwrite($abrir,"documento_que_se_modifica_numero||"."\r\n");
fwrite($abrir,"tipo_de_nota_de_credito||"."\r\n");
fwrite($abrir,"tipo_de_nota_de_debito||"."\r\n");
fwrite($abrir,"enviar_automaticamente_al_cliente|false|"."\r\n");
fwrite($abrir,"codigo_unico|F001-4|"."\r\n");
fwrite($abrir,"condiciones_de_pago||"."\r\n");
fwrite($abrir,"medio_de_pago||"."\r\n");
fwrite($abrir,"placa_vehiculo||"."\r\n");
fwrite($abrir,"orden_compra_servicio||"."\r\n");
fwrite($abrir,"tabla_personalizada_codigo||"."\r\n");
fwrite($abrir,"formato_de_pdf|TICKET|"."\r\n");
fwrite($abrir,"enviar_automaticamente_a_la_sunat|true|"."\r\n");
$H=0;
echo $arreglopro[$H];

foreach ($arreglopro as $mensaje ) {
    	$producto=explode("cadena", $arreglopro[$H]);
    	if($producto[0]="product")
    	{$pro="NIU";}
    	else
    		{$pro="NIU";}
        //precio
    	$producto[4]=round($producto[4],2);
        $producto[4]=$producto[4]*(100-$producto[6])/100;
        //aqui va el descuento
        $producto[6]=round($producto[6],2);
    	//3 cantidad
        $producto[3]=round($producto[3],3);
        //cantidad
        
    	$sinigv=round($producto[4]/1.18,2);
    	$igv=round($sinigv*0.18,2);
    		
    	$igvtotal=$producto[3]*$igv;
    	$totalli=$producto[3]*$producto[4];
    	$totasinigv=round($producto[3]*$sinigv,2);
   

$total=round($total_igv+$arreglo[6],2);
    fwrite($abrir,"item|$pro|$producto[1]|$producto[2]|$producto[3]|$sinigv|$producto[4]||$totasinigv|1|$igvtotal|$totalli|false|||"."\r\n");	

$H++;
    }





fclose($abrir);




$data_txt =file_get_contents("cadena.txt");


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ruta);
curl_setopt(
	$ch, CURLOPT_HTTPHEADER, array(
	'Authorization: Token token="'.$token.'"',
	'Content-Type: text/plain',
	)
);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_txt);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$respuesta  = curl_exec($ch);
curl_close($ch);

$final=explode("|", $respuesta);
echo print_r($respuesta);

//echo "$final[7] <br>";
//$final[7] contiene el link, para generar el pdf agregar .pdf
//se hace la consulta si la respuesta es diferente de vacio  entra(nubefact)
if($final!=null)
	//si la respuesta tiene un error muestra el error
	{if($final[0]=="errors")
		{echo "errorsuper";
         eliminarcontador($tabla,$arreglo[0]);   
    }
//si la respuesta no tiene error se carga 
	else{
		$repuesta=insertarlink($tabla,$conta,$final[7]);
		header("Location: $final[7]".".pdf");
		}
 
	}
	//aun no encuentro su utilidad
if($final[7]=null)
	{if($final[0]=="errors")
		{echo "errorsuper";}
	else{header("Location: $final[7]".".pdf");}

}?>


</body>
</html>
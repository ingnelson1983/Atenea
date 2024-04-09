<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificacion Salida Material</title>
</head>
<body>

    Hola, 
    Se ha registrado o se ha modificado, una salida de Almacen con la siguiente Información:
    <br><br>
    <table border="0">
        <tr>
             <b> Nombre Proyecto:</b> {{$salida->Proyecto->Nombre_Proyecto}}<br>
        </tr>
        <tr>  
            <b> Nombre Material:</b>  {{$salida->nom_material}}<br>
        </tr>
        <tr>             
            <b>  Unidad de Medida:</b> {{$salida->unidad_medida}}<br>
        </tr>
        <tr>   
            <b> Cantidad:</b> {{$salida->cantidad}}<br>
        </tr>
        <tr>   
            <b>  Destino:</b> {{$salida->destino }}<br>
        </tr>
        <tr>        
                <b> Descripción:</b> {{$salida->descripcion}}<br>
            </tr>
            
       
    </table>


    


    
</body>
</html>
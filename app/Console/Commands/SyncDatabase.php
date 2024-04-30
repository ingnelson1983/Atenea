<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza la base de datos con datos externos.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Comando de prueba
        $this->info('Iniciando sincronización de base de datos...');
        
        //eliminar todos los datos de la tabla sincronizaciones
        DB::table('syncs')->truncate();

        //Realizar la consulta a la base de datos externa sqlserver
        $offset = 0;
        $limit = 50000;

        while (true) {

            $consulta = 'SELECT
            01 AS "Cod_Empresa",
            empresa.EmpresaNombre AS "Nom_Empresa",
            control.ConObra AS "Codigo_Obra",
            Obra.ObrNombre AS "Nombre_Obra",
            control.ConInsumo AS "Cod_Insumo",
            Productos.ProDesc AS "Nombre_Insumo",
            concat ( control.ConInsumo, empresa.EmpPolizaNo,Productos.ProDesc ) AS "Cod_Nom_Insumo",
    /*PresupuestoDetalle.PpDNoItem,*/
            PresupuestoDetalle.PpDCodBIM AS "Cod_Item",
            Items.AITDesc AS "Nombre_Item",
            PresupuestoDetalle.PpDNota AS "Destino_Item",
                     concat ( PresupuestoDetalle.PpDCodBIM, empresa.EmpPolizaNo , Items.AITDesc, empresa.EmpPolizaNo, PresupuestoDetalle.PpDNota ) AS "Cod_Nom_Destino_Item" 
        FROM
            ADPControl.dbo.ADPControlSincoConstruccionesCFC_Nueva AS control
            INNER JOIN SincoConstruccionesCFC_Nueva.DBO.ADPObras AS Obra ON Obra.ObrObra = control.ConObra
            INNER JOIN SincoConstruccionesCFC_Nueva.DBO.ADPPresupuesto AS Presupuesto ON control.ConCap = Presupuesto.PptId
            INNER JOIN SincoConstruccionesCFC_Nueva.DBO.ADPPptoDet AS PresupuestoDetalle ON Presupuesto.PptId = PresupuestoDetalle.PpDPpt 
            AND control.ConItem = PresupuestoDetalle.PpDId
            INNER JOIN SincoConstruccionesCFC_Nueva.DBO.ADPItems AS Items ON PresupuestoDetalle.PpDItem = Items.AITCod
            INNER JOIN SincoConstruccionesCFC_Nueva.DBO.Productos ON control.ConInsumo = Productos.ProCod 
                    INNER JOIN SincoConstruccionesCFC_Nueva.DBO.Empresas AS empresa ON empresa.EmpresaNit = 810002455/*WHERE
    ConObra = 1 
    AND ConInsumo = 1633 */
            
        GROUP BY
            control.ConObra,
            Obra.ObrNombre,
            control.ConInsumo,
            PresupuestoDetalle.PpDNoItem,
            PresupuestoDetalle.PpDCodBIM,
            Items.AITDesc,
                PresupuestoDetalle.PpDNota,
                Productos.ProDesc,
                empresa.EmpresaNombre,
                empresa.EmpPolizaNo
    
             UNION
        
        SELECT
                        02 AS "Cod_Empresa",
                empresa.EmpresaNombre AS "Nom_Empresa",
                control.ConObra AS "Codigo_Obra",
                Obra.ObrNombre AS "Nombre_Obra",
                control.ConInsumo AS "Cod_Insumo",
                Productos.ProDesc AS "Nombre_Insumo",
                concat ( control.ConInsumo, empresa.EmpPolizaNo,Productos.ProDesc ) AS "Cod_Nom_Insumo",
            /*PresupuestoDetalle.PpDNoItem,*/
                PresupuestoDetalle.PpDCodBIM AS "Cod_Item",
                Items.AITDesc AS "Nombre_Item",
                PresupuestoDetalle.PpDNota AS "Destino_Item",
                concat ( PresupuestoDetalle.PpDCodBIM, empresa.EmpPolizaNo , Items.AITDesc, empresa.EmpPolizaNo, PresupuestoDetalle.PpDNota ) AS "Cod_Nom_Destino_Item" 
        FROM
            ADPControl.dbo.ADPControlSincoConstruccionesCFCDULaFlorida_Nueva AS control
            INNER JOIN SincoConstruccionesCFCDULaFlorida_Nueva.DBO.ADPObras AS Obra ON Obra.ObrObra = control.ConObra
            INNER JOIN SincoConstruccionesCFCDULaFlorida_Nueva.DBO.ADPPresupuesto AS Presupuesto ON control.ConCap = Presupuesto.PptId
            INNER JOIN SincoConstruccionesCFCDULaFlorida_Nueva.DBO.ADPPptoDet AS PresupuestoDetalle ON Presupuesto.PptId = PresupuestoDetalle.PpDPpt 
            AND control.ConItem = PresupuestoDetalle.PpDId
            INNER JOIN SincoConstruccionesCFCDULaFlorida_Nueva.DBO.ADPItems AS Items ON PresupuestoDetalle.PpDItem = Items.AITCod
            INNER JOIN SincoConstruccionesCFCDULaFlorida_Nueva.DBO.Productos ON control.ConInsumo = Productos.ProCod 
                     INNER JOIN SincoConstruccionesCFCDULaFlorida_Nueva.DBO.Empresas AS empresa ON empresa.EmpresaNit = 901499652/*WHERE
    ConObra = 1 
    AND ConInsumo = 1633 */
            
        GROUP BY
            control.ConObra,
            Obra.ObrNombre,
            control.ConInsumo,
            PresupuestoDetalle.PpDNoItem,
            PresupuestoDetalle.PpDCodBIM,
            Items.AITDesc,
                PresupuestoDetalle.PpDNota,
                Productos.ProDesc,
                empresa.EmpresaNombre,
                empresa.EmpPolizaNo
         UNION

       
        SELECT
                03 AS "Cod_Empresa",
                empresa.EmpresaNombre AS "Nom_Empresa",
                control.ConObra AS "Codigo_Obra",
                Obra.ObrNombre AS "Nombre_Obra",
                control.ConInsumo AS "Cod_Insumo",
                Productos.ProDesc AS "Nombre_Insumo",
                concat ( control.ConInsumo, empresa.EmpPolizaNo,Productos.ProDesc ) AS "Cod_Nom_Insumo",
            /*PresupuestoDetalle.PpDNoItem,*/
                PresupuestoDetalle.PpDCodBIM AS "Cod_Item",
                Items.AITDesc AS "Nombre_Item",
                PresupuestoDetalle.PpDNota AS "Destino_Item",
                concat ( PresupuestoDetalle.PpDCodBIM, empresa.EmpPolizaNo , Items.AITDesc, empresa.EmpPolizaNo, PresupuestoDetalle.PpDNota ) AS "Cod_Nom_Destino_Item" 
            FROM
                ADPControl.dbo.ADPControlSincoConstruccionesCFCConsLibia_Nueva AS control
                INNER JOIN SincoConstruccionesCFCConsLibia_Nueva.DBO.ADPObras AS Obra ON Obra.ObrObra = control.ConObra
                INNER JOIN SincoConstruccionesCFCConsLibia_Nueva.DBO.ADPPresupuesto AS Presupuesto ON control.ConCap = Presupuesto.PptId
                INNER JOIN SincoConstruccionesCFCConsLibia_Nueva.DBO.ADPPptoDet AS PresupuestoDetalle ON Presupuesto.PptId = PresupuestoDetalle.PpDPpt 
                AND control.ConItem = PresupuestoDetalle.PpDId
                INNER JOIN SincoConstruccionesCFCConsLibia_Nueva.DBO.ADPItems AS Items ON PresupuestoDetalle.PpDItem = Items.AITCod
                INNER JOIN SincoConstruccionesCFCConsLibia_Nueva.DBO.Productos ON control.ConInsumo = Productos.ProCod
                INNER JOIN SincoConstruccionesCFCConsLibia_Nueva.DBO.Empresas AS empresa ON empresa.EmpresaNit = 901550146 /*WHERE
            ConObra = 1 
            AND ConInsumo = 1633 */
                
            GROUP BY
                control.ConObra,
                Obra.ObrNombre,
                control.ConInsumo,
                PresupuestoDetalle.PpDNoItem,
                PresupuestoDetalle.PpDCodBIM,
                Items.AITDesc,
                PresupuestoDetalle.PpDNota,
                Productos.ProDesc,
                empresa.EmpresaNombre,
                empresa.EmpPolizaNo

ORDER BY
Nom_Empresa,
Obra.ObrNombre,
PresupuestoDetalle.PpDCodBIM
OFFSET '.$offset.' ROWS FETCH NEXT '.$limit.' ROWS ONLY';

        $data = DB::connection('sqlsrv')->select($consulta);

        if (empty($data)) {
            break;
        }

        //Insertar los datos en la tabla sincronizaciones
        foreach ($data as $row) {
            DB::table('syncs')->insert((array) $row);
        }

        $offset += $limit;
    }

    $this->info('Sincronización de base de datos finalizada.');
}
}
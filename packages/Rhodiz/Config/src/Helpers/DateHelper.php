<?php

namespace Rhodiz\Config\Helpers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class DateHelper
{
    /**
     * Devuelve una expresión DB::raw con el formato de fecha deseado.
     *
     * @param string $column Nombre de la columna en formato "tabla.columna".
     * @param string|null name of AS part of SQL select
     * @return \Illuminate\Database\Query\Expression
     */
    public static function formatDateRaw($column, $ASString = null, $format = null)
    {
        // Obtiene el formato desde la configuración si no se especifica.
        $format = $format ?? config('app.date_format', 'Y-m-d H:i:s');

        // Convierte el formato de PHP a MySQL
        $mysqlFormat = self::convertDateFormatToMySQL($format);

        if ($ASString == null) {
            $ASString = explode('.', $column)[1];
        }

        // Devuelve la expresión DB::raw con DATE_FORMAT.
        return DB::raw("DATE_FORMAT($column, '$mysqlFormat') as " . $ASString);
    }

    /**
     * Convierte un formato de fecha de PHP a MySQL.
     *
     * @param string $format Formato de fecha en estilo PHP.
     * @return string Formato de fecha compatible con MySQL.
     */
    protected static function convertDateFormatToMySQL($format)
    {
        $replacements = [
            'Y' => '%Y', // Año en cuatro dígitos
            'y' => '%y', // Año en dos dígitos
            'm' => '%m', // Mes en dos dígitos
            'n' => '%c', // Mes sin ceros iniciales
            'd' => '%d', // Día en dos dígitos
            'j' => '%e', // Día sin ceros iniciales
            'H' => '%H', // Hora en formato de 24 horas
            'h' => '%h', // Hora en formato de 12 horas
            'i' => '%i', // Minutos en dos dígitos
            's' => '%s', // Segundos en dos dígitos
            'A' => '%p', // AM o PM en mayúsculas
            'a' => '%p', // am o pm en minúsculas
        ];

        return strtr($format, $replacements);
    }

    public static function getDateFormat()
    {
        return config('app.date_format', 'Y-m-d H:i:s');
    }

    public static function getOnlyDateFormat()
    {
        return config('app.only_date_format', 'Y-m-d');
    }

    public static function changeStringDateFomat($value, $oldFormat, $newFormat)
    {
        if (empty($value)) {
            return false;
        }

        //Cambio de formato
        if (Carbon::createFromFormat($oldFormat, $value)->isValid()) {
            return Carbon::createFromFormat($oldFormat, $value)->format($newFormat);
        } else {
            return false;
        }
    }
}

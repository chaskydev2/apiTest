# Alberto Zarraga - Prueba Tecnica
# Parte C

1) ¿Qué permisos asignarías a un archivo de llave privada y por qué?

R - Solo los permisos necesarios para acceder a la llave privada, como leer y escribir.

2) Comandos para limpiar cache de Laravel.

R - php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

3) Cómo mantener workers de cola en producción.

R - 

4) ¿Dónde revisar errores de app y servidor?

R - En los logs de la aplicación y el servidor.

5) Esquema básico de .htaccess para SPA.

R- 

6) Comando para backup/restore MySQL.

R - 


7) ¿Qué es OPcache y por qué ayuda?

R -

8) Riesgos de exponer .env y cómo evitarlos.

R - Exponer el archivo .env puede posesionar riesgos de seguridad, ya que contiene información sensible como contraseñas y claves de API. Para evitarlo, se debe asegurarse de que el archivo no sea accesible.

9) Comando ufw para abrir solo 80/443.

R - 

10) Cómo asegurar permisos de storage y bootstrap/cache.

R - Asegurar permisos de storage y bootstrap/cache es importante para proteger la aplicación contra accesos no autorizados. 


# Parte D - SQL

1) Top 3 categorías por promedio de rating.

SELECT category, AVG(rating) as avg_rating
FROM restaurants
GROUP BY category_id
ORDER BY avg_rating DESC
LIMIT 3;

2) Conteo de favoritos en restaurantes especiales.

SELECT r.id, r.name, COUNT(f.id) AS total_favs
FROM restaurants r
JOIN favorites f ON f.restaurant_id = r.id
WHERE r.is_special = 1
GROUP BY r.id, r.name;

3) Restaurantes con nombre duplicado.

SELECT name, COUNT(*) as name_count
FROM restaurants
GROUP BY name
HAVING name_count > 1;

# Parte E — Debug rápido
Analiza el siguiente snippet y encuentra problemas (escribe tu análisis debajo):


public function index(Request $request)
{
   $q = Restaurant::query()->with('category');
   if ($request->search) {
       $q->where('name', 'like', "%$request->search%");
   }
   if ($request->special) {
       $q->where('is_special', $request->special);
   }
   return RestaurantResource::collection(
       Cache::remember('restaurants', 60, fn() => $q->paginate(10))
   );
}

R - 
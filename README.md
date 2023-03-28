# Concurs Élancé
Aplicació Enfocada a la gestió del Concurs Élancé de Blanes

S'ha de tenir en compte varies coses

## .env
El fitxer .env s'ha de configurar pel correcte funcionament, implica tenir en compte usuaris i contrasenyes de bases de dades.

## Migrate
S'ha de realitzar també un migrate de la Base de dades

## Usuari i contrasenya
L'administració al fer un migrate té per defecte la contrasenya admin admin,
Els usuaris quan es generen segons els usuaris que es vulguin generar tenen per usuari i contrasenya jutgex (x = nº de jutge),
@TODO
La taula de generacio d'usuaris no es mostren els usuaris, la intenció és tenir una taula backup de contrasenyes dels jutges així poder modificar-les per altres i també el seu nom d'usuari.

Falta per mostrar la taula de resultats.

Cal finalitzar el front-end de Gestió de Blocs

Caldrà un parell de retocs de la base de dades per poder generar un ordre de pase. Seria un número no únic ja que varies participacions poden formar part d'un grup.

Les votacions de Jutges cal que des de la propia pàgina de Gestió de blocs habilitar i deshabilitar-los, en la qual cosa un jutge si no li toca votar no votaria.
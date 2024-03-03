# README

Aquesta base de dades emmagatzema informació d'usuaris, incloent credencials i tokens de recuperació.

## Trigger `before_update_usuaris`

He creat un trigger (`before_update_usuaris`) que s'executa abans de les actualitzacions a la taula `usuaris`:

- Si actualitzo el camp `token` i `token_creation_time` és NULL, l'estableixo amb la data/hora actual.
- Si no es proporciona un valor per a `token_creation_time`, el deixo com a NULL.

Aquest trigger garanteix que `token_creation_time` s'actualitzi bé amb el token i tingui un valor per defecte de NULL si no se n'ha proporcionat cap.

## Codi `CONTROLADOR/LOGIN`

Dins del codi he aconseguit fer la part de login amb `OAuth2.0`, però no he aconseguit fer la part de `HybridAuth`, ja que no he aconseguit fer que funcioni la API de GitHub.

Amb OAuth2.0 he aconseguit fer que funcioni amb `Google` i he emmagatzemat el token d'accés a la base de dades.

## Dades d'accés

- **Usuari**: elyass909@gmail.com
- **Contrasenya**: 1234
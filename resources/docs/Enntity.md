# Entidades

Las entidades son una representacion extructural de los datos, nos sirven para
identificar un tipo de contenido y poder extenderlo manteniendo la integridad
de datos.

## Caso de estudio

Para el sistema de reportes deberemos contar con una entidad llamada ```track```
que contendra la información recolectada para un evento determinado, esta
entidad nos proporcionara la información necesaria para armar las diferentes
metricas

```
{
  hostname : 'sitio.com',
  date : @date,
  eventCategory : 'someCategory',
  data: {
    @mixed : {}
  },


}
```

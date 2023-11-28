import swaggerJsdoc from 'swagger-jsdoc'
import { serve, setup } from 'swagger-ui-express'

const descriptionProjeto = ` 

## Sobre
Uma ferramenta API para busca de informações sobre Fundos Imobiliarios.

## Objetivo
Trazer informações de fundos imobiliários listados na B3

## Premissas
As informações serão disponibilizada em formato chave valor (JSON).

## Escopo

`;

const descriptionTeste = ` 

Rota para testar conexão e comunicação.

## Base URL
~~~
http://localhost:3000
~~~

## Endpoint
~~~
GET /
~~~

## Headers
~~~
Content-Type: application/json
~~~

## Params
~~~
~~~

## Body raw (json)
~~~
~~~

## Response body
~~~
{
    "sucess": true,
    "errors": [],
    "content": {}
}
~~~

## Erros
A API pode retornar os seguintes Códigos de resposta:
* 200 OK: indica execução com sucesso.
* 201 Created: indica que foi criado com sucesso.
* 400 - Bad Request: ocorre quando a requisição é inválida, geralmente porque está faltando algum parâmetro obrigatório ou o formato dos parâmetros está incorreto.
* 401 Unauthorized: indica que a requisição não está autenticada ou que o usuário autenticado não tem permissão para visualizar as tarefas.
* 403 Forbidden: ocorre quando o usuário autenticado não tem permissão para acessar o recurso solicitado.
* 404 - Not Found: ocorre quando a rota especificada não existe.
* 500 - Internal Server Error: ocorre quando ocorre um erro interno no servidor.

`;

const descriptionFundos = ` 

Lista e retorna informações dos fundos cadastrados na B3.

## Base URL
~~~
http://localhost:3000
~~~

## Endpoint
~~~
GET /fundos
~~~

## Headers
~~~
Content-Type: application/json
~~~

## Params
~~~
~~~

## Body raw (json)
~~~
~~~

## Response body
~~~
{
    "sucess": true,
    "errors": [],
    "content": {}
}
~~~

## Erros
A API pode retornar os seguintes Códigos de resposta:
* 200 OK: indica execução com sucesso.
* 201 Created: indica que foi criado com sucesso.
* 400 - Bad Request: ocorre quando a requisição é inválida, geralmente porque está faltando algum parâmetro obrigatório ou o formato dos parâmetros está incorreto.
* 401 Unauthorized: indica que a requisição não está autenticada ou que o usuário autenticado não tem permissão para visualizar as tarefas.
* 403 Forbidden: ocorre quando o usuário autenticado não tem permissão para acessar o recurso solicitado.
* 404 - Not Found: ocorre quando a rota especificada não existe.
* 500 - Internal Server Error: ocorre quando ocorre um erro interno no servidor.

`;

const descriptionFundo = ` 

Busca e retorna informações do Fundo solicitado.

## Base URL
~~~
http://localhost:3000
~~~

## Endpoint
~~~
GET /fundo/{cod}
~~~

## Headers
~~~
Content-Type: application/json
~~~

## Params
~~~
{cod} - código do fundo registrado na B3
~~~

## Body raw (json)
~~~
~~~

## Response body
~~~
{
    "sucess": true,
    "errors": [],
    "content": {}
}
~~~

## Erros
A API pode retornar os seguintes Códigos de resposta:
* 200 OK: indica execução com sucesso.
* 201 Created: indica que foi criado com sucesso.
* 400 - Bad Request: ocorre quando a requisição é inválida, geralmente porque está faltando algum parâmetro obrigatório ou o formato dos parâmetros está incorreto.
* 401 Unauthorized: indica que a requisição não está autenticada ou que o usuário autenticado não tem permissão para visualizar as tarefas.
* 403 Forbidden: ocorre quando o usuário autenticado não tem permissão para acessar o recurso solicitado.
* 404 - Not Found: ocorre quando a rota especificada não existe.
* 500 - Internal Server Error: ocorre quando ocorre um erro interno no servidor.

`;

const options = {
  swaggerDefinition: {
 
      "openapi": "3.0.3",
      "info": {
        "version": "1.0.0",
        "title": "Funds Explorer API",
        "description": descriptionProjeto,
        "termsOfService": "http://swagger.io/terms/",
        "contact": {
          "name": "Your Name",
          "email": "your.email@example.com",
          "url": "web.com"
        },
        "license": {
          "name": "Apache 2.0",
          "url": "http://www.apache.org/licenses/LICENSE-2.0.html"
        },
        externalDocs: {
          "description": "Find out more about Swagger",
          "url": "http://swagger.io"
        }
      },
      "servers": [
        {
          "url": "http://localhost:3000",
          "description": "Rota Base"
        }
      ],
      "paths": {
        "/": {
          "get": {
            "tags": [
              "- Rota Teste"
            ],
            "summary": "Test",
            "description": descriptionTeste,
            "parameters": {},
            "responses": {
              "200": {
                "description": "Successful response",
                "content": {
                  "application/json":{
                    "schema": {
                      "type": "array",
                      "items": {
                        "$ref": ""
                      }
                    }
                  }
                }
              },
              '400':{
                "description": "Invalid status value"
              },
              "500": {
                "description": "Internal server error"
              }
            }
          }
        },
        "/fundos": {
          "get": {
            "tags": [
              "- Buca Fundos Listados na B3"
            ],
            "summary": "Fundos",
            "description": descriptionFundos,
            "parameters": {},
            "responses": {
              "200": {
                "description": "Successful response",
                "content": {
                  "application/json":{
                    "schema": {
                      "type": "array",
                      "items": {
                        "$ref": "#/components/schemas/Fund"
                      }
                    }
                  }
                }
              },
              '400':{
                "description": "Invalid status value"
              },
              "500": {
                "description": "Internal server error"
              }
            }
          }
        },
        "/fundo/{cod}": {
          "get": {
            "tags": [
              "- Busca Fundo Especificado"
            ],
            "summary": "Fundo",
            "description": descriptionFundo,
            "parameters": [
              {
                "name": "cod",
                "in": "path",
                "required": true,
                "type": "string"
              }
            ],
            "responses": {
              "200": {
                "description": "Successful response",
                "schema": {
                  "$ref": "#/components/schemas/Fund"
                }
              },
              "404": {
                "description": "Fund not found"
              },
              "500": {
                "description": "Internal server error"
              }
            }
          }
        }
      },
      "components": {
        "schemas": {
          "Fund": {
            "type": "object",
            "properties": {
              "fonte": {
                "type": "string",
                "example": "https://www.site.com.br"
              },
              "data": {
                "type": "date",
                "example": "30/02/2000"
              },
              "codigo": {
                "type": "string",
                "example": "ORPD11"
              },
              "setor": {
                "type": "string",
                "example": "Títulos e Val. Mob."
              },
              "preco_atual": {
                "type": "string",
                "example": "00.00"
              },
              "liquidez_diaria": {
                "type": "string",
                "example": "00.0"
              },
              "dividendo": {
                "type": "string",
                "example": "0.00"
              },
              "dividend_yield": {
                "type": "string",
                "example": "0.00"
              },
              "dy_3m_acumulado": {
                "type": "string",
                "example": "0.00"
              },
              "dy_6m_acumulado": {
                "type": "string",
                "example": "0.00"
              },
              "dy_12m_acumulado": {
                "type": "string",
                "example": "0.00"
              },
              "dy_3m_media": {
                "type": "string",
                "example": "0.00"
              },
              "dy_6m_media": {
                "type": "string",
                "example": "0.00"
              },
              "dy_12m_media": {
                "type": "string",
                "example": "0.00"
              },
              "dy_ano": {
                "type": "string",
                "example": "0.00"
              },
              "variacao_preco": {
                "type": "string",
                "example": "0.00"
              },
              "rentab_periodo": {
                "type": "string",
                "example": "0.00"
              },
              "rentab_acumulada": {
                "type": "string",
                "example": "0.00"
              },
              "patrimonio_liq": {
                "type": "string",
                "example": "0.00"
              },
              "vpa": {
                "type": "string",
                "example": "0.00"
              },
              "dy_patrimonial": {
                "type": "string",
                "example": "0.00"
              },
              "variacao_patrimonial": {
                "type": "string",
                "example": "0.00"
              },
              "rentab_patr_no_periodo": {
                "type": "string",
                "example": "0.00"
              },
              "rentab_patr_acumulada": {
                "type": "string",
                "example": "0.00"
              },
              "vacancia_fisica": {
                "type": "string",
                "example": "0.00"
              },
              "vacancia_financeira": {
                "type": "string",
                "example": "0.00"
              },
              "quantidade_ativos": {
                "type": "string",
                "example": "0.00"
              },
              "liquidez": {
                "type": "string",
                "example": "0.00"
              },
              "custo_mercado": {
                "type": "string",
                "example": "Menor"
              },
              "saldo": {
                "type": "string",
                "example": "0.00"
              },
              "qtd_cota_mult": {
                "type": "string",
                "example": "0.00"
              },
              "vlr_cota_mult": {
                "type": "string",
                "example": "0.00"
              },
              "qtd_cota_viver": {
                "type": "string",
                "example": "0.00"
              },
              "vlr_cota_viver": {
                "type": "string",
                "example": "0.00"
              }              
            }
          }
        }
      }
  },
  apis: ['funds.explorer.routes.js']
}

const specs = swaggerJsdoc(options)

export default (app) => {
  app.use('/api-docs', serve, setup(specs))
}

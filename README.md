
# API de Vendas

Esta API permite consultar as vendas realizadas no sistema, incluindo os status de pagamento e entrega.

---

## Listar todas as vendas

### GET `/api/vendas`

Retorna todas as vendas cadastradas.

### Resposta (200)

```json
[
  {
    "id": 1,
    "valor_total": 150.00,
    "status_pagamento": "Aprovado",
    "status_entrega": "Entregue",
    "created_at": "2026-06-28T15:30:00.000000Z",
    "cliente": {
      "id": 1,
      "nome": "João Silva",
      "cpf": "123.456.789-00"
    },
    "endereco": {
      "id": 3,
      "descricao": "Rua das Flores, 100"
    },
    "produtos": [
      {
        "id": 5,
        "nome": "Arroz",
        "quantidade": 2
      }
    ]
  }
]
```

---

## Consultar uma venda

### GET `/api/vendas/{id}`

Retorna os dados de uma venda específica.

### Parâmetros

| Campo | Tipo | Descrição |
|--------|------|-----------|
| id | integer | ID da venda |

### Resposta (200)

```json
{
  "id": 1,
  "valor_total": 150.00,
  "status_pagamento": "Aprovado",
  "status_entrega": "Em Transporte",
  "created_at": "2026-06-28T15:30:00.000000Z",
  "cliente": {
    "id": 1,
    "nome": "João Silva"
  },
  "endereco": {
    "id": 3,
    "descricao": "Rua das Flores, 100"
  },
  "produtos": [
    {
      "id": 5,
      "nome": "Arroz",
      "quantidade": 2
    }
  ]
}
```

---

## Consultar apenas os status da venda

### GET `/api/vendas/{id}/status`

Retorna apenas os status de pagamento e entrega da venda.

### Resposta (200)

```json
{
  "id": 1,
  "status_pagamento": "Aprovado",
  "status_entrega": "Entregue"
}
```

---

## Status possíveis

### Pagamento

- Pendente
- Aprovado
- Negado

### Entrega

- Aguardando
- Recebido
- Em Transporte
- Entregue
- Cancelado

---

## Atualizar status da entrega

### POST `/api/entrega/status`

Endpoint utilizado pelo Caçalog para atualizar o status da entrega.

### Body

```json
{
  "pedido": 1,
  "status": "Entregue"
}
```

### Resposta (200)

```json
{
  "ok": true
}
```
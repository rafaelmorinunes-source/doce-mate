# Textos jurídicos

As quatro páginas obrigatórias para loja virtual no Brasil, escritas e prontas
para publicar no WordPress.

## Como preencher

Os documentos deste diretório são **modelos** — os dados variáveis estão como
`{{TOKEN}}`. Você não precisa editá-los à mão.

1. Preencha **`dados-da-loja.conf`** — são 12 informações, uma vez só
2. Rode:

```bash
python3 juridico/preencher.py
```

3. Os textos completos aparecem em **`juridico/publicar/`**, sem lacunas
4. Copie cada um para uma página do WordPress

Se faltar algum dado, o script diz exatamente qual e em quais documentos —
e não gera nada. É proposital: política publicada com lacuna é pior que
política ausente.

Mudou o horário da loja ou o WhatsApp? Edite o `.conf`, rode de novo, republique.

## Por que não editar direto

As mesmas informações se repetem 33 vezes nos quatro documentos. O endereço
aparece 4 vezes, o WhatsApp 4, a data 4. Editando à mão, é quase certo que uma
escape — e o lugar onde ela escapa é uma página que o Procon pode ler.

## Antes de publicar

- [ ] Conferir se os prazos batem com a operação real (não prometa postar em
      2 dias úteis se a postagem sai em 4)
- [ ] Conferir se a razão social e o CNPJ batem exatamente com o cartão CNPJ
- [ ] **Pedir para um advogado revisar**

> Estes são modelos baseados na legislação brasileira vigente e não substituem
> orientação jurídica. Loja com CNPJ vendendo a consumidor final responde
> perante o Procon.

## O que cada documento cumpre

| Arquivo | Base legal |
|---------|-----------|
| `politica-de-troca-e-devolucao.md` | CDC art. 49 (arrependimento), art. 18 e 26 (vício do produto) |
| `politica-de-privacidade.md` | LGPD (Lei 13.709/2018) |
| `politica-de-frete-e-entrega.md` | CDC art. 30 e 35 (oferta e prazo) |
| `termos-de-uso.md` | Decreto 7.962/2013 (Lei do E-commerce), Marco Civil da Internet |

## Obrigatório fora destas páginas

O Decreto 7.962/2013 exige, **visível em todas as páginas do site** — use o
rodapé:

- Razão social completa
- CNPJ
- Endereço físico
- E-mail e telefone de atendimento

Além disso, o site precisa confirmar o pedido por e-mail e manter um canal de
atendimento que responda em até 5 dias.

## Sobre o DPO

A LGPD exige um **encarregado de dados**. Não precisa ser advogado nem
profissional contratado — em empresa pequena costuma ser a própria dona. O que
importa é que seja um nome e um e-mail de alguém que efetivamente responda
quando um cliente pedir seus dados.

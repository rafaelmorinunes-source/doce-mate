# 3. Pagamentos, frete e nota fiscal

Esta é a parte que faz a loja sair do papel: receber dinheiro, entregar a peça
e emitir documento. Nenhuma das três pode ficar para depois.

---

## 3.0 Antes de tudo: checkout clássico, não em blocos

O WooCommerce hoje tem **dois checkouts diferentes**, e instalações novas vêm
com o **checkout em blocos** ligado por padrão. Para loja brasileira, isso
precisa ser trocado antes de configurar qualquer outra coisa.

### O problema

O checkout padrão do WooCommerce é americano: **não tem campo de CPF e não tem
bairro**. Isso não é questão de estética — sem CPF você **não consegue emitir
nota fiscal**, e sem bairro o endereço sai incompleto para a transportadora.
São dois bloqueios legais e operacionais.

Quem resolve é o plugin de campos brasileiros, e **qual plugin você escolhe
determina se pode usar o checkout em blocos**.

### Depende do plugin de campos

| Plugin | Checkout em blocos |
|--------|--------------------|
| Brazilian Market on WooCommerce | **Não funciona** — e está sem manutenção |
| Calculadora de Frete e Campos Checkout para o Brasil | Funciona nos dois |

O **Mercado Pago** funciona nos dois modos. Quem força a decisão é sempre o
plugin de campos, nunca o de pagamento.

### A recomendação

Use o plugin da **Link Nacional** (ver [doc 02](02-setup-hostinger-woocommerce.md#28-plugins-essenciais))
e **comece no checkout clássico mesmo assim**.

Não por incompatibilidade — ele suporta blocos —, mas porque o resto do
ecossistema brasileiro de frete e NF-e ainda foi escrito assumindo o clássico,
e porque **trocar de checkout obriga a refazer todos os testes**. Faça as
primeiras vendas no que já validou.

Depois do lançamento, com a operação rodando, vale experimentar o de blocos
num momento calmo. Aí o custo de errar é só seu tempo, não um pedido perdido.

### Como trocar

1. **Páginas → Finalizar compra**, abrir para edição
2. Selecionar o bloco *Finalizar compra* e, na barra de ferramentas do bloco,
   usar a opção de **voltar ao checkout clássico**
3. Se a opção não aparecer, apague o bloco e coloque no lugar um bloco de
   *código curto* com: `[woocommerce_checkout]`
4. Repetir na página **Carrinho**, com `[woocommerce_cart]`
5. Atualizar as duas páginas

Faça essa troca **antes** de configurar frete e pagamento. Trocar depois
obriga a refazer todos os testes.

### Como conferir que deu certo

Com o plugin de campos brasileiros instalado, abra o checkout com um produto
no carrinho. Devem aparecer:

- Seletor **Pessoa Física / Pessoa Jurídica**
- Campo **CPF** (ou CNPJ)
- Campo **Bairro**
- CEP preenchendo rua, bairro e cidade sozinho

Faltando algum, o problema é o plugin de campos — não o modo de checkout, já
que o da Link Nacional funciona nos dois. Confira se ele está ativo e se os
campos não foram desmarcados nas configurações dele.

---

## 3.1 Pagamentos — Mercado Pago

### Por que Mercado Pago

- Aceita **PIX, cartão de crédito, débito e boleto** em uma integração só
- Plugin oficial para WooCommerce, mantido e em português
- **Sem mensalidade** — só percentual por venda
- Marca conhecida: reduz o medo de comprar em loja nova

Alternativas boas: **PagBank** (taxas parecidas) e **InfinitePay** (taxa menor
no PIX). Se sua mãe já usa maquininha de algum deles, vale unificar para
simplificar a conciliação.

### Taxas (referência)

| Meio | Taxa aproximada | Prazo de recebimento |
|------|-----------------|---------------------|
| PIX | ~0,99% | Na hora |
| Cartão de crédito | ~4,98% | 14 dias |
| Cartão parcelado | maior conforme parcelas | 14 dias |
| Boleto | ~3,49% | 1 a 3 dias após pagamento |

Confirme os valores atuais no painel do Mercado Pago — mudam com frequência e
melhoram conforme o volume.

### Configuração

1. Criar conta no Mercado Pago **com o CNPJ da Doce Mate** (não com CPF —
   taxas de PJ são melhores e a nota fiscal precisa bater com o recebedor)
2. Instalar o plugin **Mercado Pago para WooCommerce**
3. No painel do Mercado Pago, ir em *Seu negócio → Configurações →
   Credenciais* e copiar **Public Key** e **Access Token**
4. Colar nas configurações do plugin no WordPress
5. Ativar PIX, cartão e boleto
6. Testar com as **credenciais de teste** antes de ir ao ar

### Incentive o PIX

Configure **5% de desconto no PIX** (o plugin tem essa opção nativa). Você
economiza ~4% de taxa de cartão, recebe na hora e o cliente sente que ganhou
vantagem. É o único desconto que se paga sozinho.

### Parcelamento

Ofereça em até **3x sem juros** para compras acima de R$ 150. Em vestuário
infantil o ticket médio é baixo; parcelamento longo não aumenta conversão e só
atrasa seu recebimento.

---

## 3.2 Frete — Melhor Envio + retirada na loja

### Melhor Envio

Intermediador que dá acesso a Correios (PAC/SEDEX), Jadlog, Loggi e outras com
**preço de grande volume** — costuma sair 40% a 60% mais barato que balcão dos
Correios. Gratuito, você paga só o frete de cada envio.

Configuração:

1. Criar conta em `melhorenvio.com.br` com o CNPJ
2. Instalar o plugin **Melhor Envio** no WordPress
3. Conectar via token gerado no painel
4. Definir o **CEP de origem** — o endereço da loja física em Porto Alegre
5. Ativar as transportadoras que quiser oferecer

### Dimensões e peso — não pule isso

O frete é calculado por peso *e* volume. Se você cadastrar produto sem essas
informações, o cálculo sai errado e você paga a diferença do próprio bolso.

Valores de referência para vestuário infantil (embalado):

| Tipo de peça | Peso | Dimensões (C×L×A cm) |
|--------------|------|---------------------|
| Body / camiseta | 150 g | 20 × 15 × 3 |
| Vestido | 250 g | 25 × 20 × 4 |
| Conjunto | 350 g | 30 × 22 × 5 |
| Casaco / moletom | 500 g | 32 × 25 × 8 |
| Saída de maternidade | 600 g | 35 × 28 × 10 |

Pese algumas peças reais numa balança de cozinha e ajuste. Cinco minutos aqui
evitam prejuízo em todo pedido.

> **Cuidado:** os Correios cobram por **peso cubado** quando o volume é grande
> em relação ao peso. Roupa infantil é leve e fofa — comprima bem a embalagem.
> Embalagem menor é frete menor.

### Retirada na loja — sua maior vantagem

Ative **retirada grátis na loja física**. Em WooCommerce: *Configurações →
Entrega → Adicionar zona de entrega*.

Monte assim:

| Zona | Região | Método |
|------|--------|--------|
| Porto Alegre | CEPs de POA | Retirada na loja (R$ 0) + PAC + SEDEX |
| Rio Grande do Sul | Estado RS | PAC + SEDEX |
| Brasil | Restante | PAC + SEDEX |

Por que isso importa tanto em moda infantil: a dúvida de tamanho é o principal
motivo de abandono de carrinho. "Compro online e troco na loja se não servir"
elimina o risco da compra — e traz a cliente até a loja física, onde ela
costuma levar mais uma peça.

### Frete grátis

Configure frete grátis acima de um valor — comece em **R$ 249** para o Rio
Grande do Sul. Aumenta o ticket médio ("falta pouco para o frete grátis") sem
comer margem em pedido pequeno. Revise depois de dois meses com dados reais.

---

## 3.3 Nota fiscal

A Doce Mate tem CNPJ, então **emitir NF-e em venda online é obrigatório**.
Não há a informalidade que o Instagram permite: o pedido tem rastreio,
pagamento registrado e destinatário identificado.

### Como resolver

**Opção A — Bling ou Tiny ERP (recomendado)**

ERPs brasileiros que integram com WooCommerce e emitem NF-e automaticamente a
cada pedido. Custam a partir de ~R$ 60/mês.

Vale a pena quando passar de ~1 pedido por dia: a emissão manual vira o
gargalo da operação, e o ERP ainda unifica o estoque da loja física com o da
loja virtual — que é o problema seguinte que você vai ter.

**Opção B — Emissor gratuito da SEFAZ-RS (para começar)**

Emitir manualmente pelo emissor da Secretaria da Fazenda do RS. Grátis, porém
trabalhoso. Funciona nos primeiros meses, com poucos pedidos por dia.

### Fale com o contador antes de ligar a loja

Duas perguntas específicas, que mudam a configuração da loja:

1. **Qual CFOP usar em venda interestadual para consumidor final?**
   (normalmente 6108, mas confirme — muda o cálculo de imposto)
2. **O regime tributário atual cobre venda online?**
   (Simples Nacional geralmente cobre, mas a atividade de comércio eletrônico
   pode precisar constar no CNAE)

Resolver isso antes custa uma conversa. Resolver depois custa multa.

---

## 3.4 Checklist desta etapa

- [ ] Conta Mercado Pago criada com CNPJ
- [ ] Plugin conectado e testado com credenciais de teste
- [ ] PIX com 5% de desconto ativo
- [ ] Parcelamento em até 3x configurado
- [ ] Conta Melhor Envio criada e conectada
- [ ] CEP de origem = loja física
- [ ] Zonas de entrega criadas (POA / RS / Brasil)
- [ ] Retirada na loja ativa e gratuita
- [ ] Frete grátis acima de R$ 249 no RS
- [ ] Peso e dimensões definidos para cada tipo de peça
- [ ] Contador consultado sobre CFOP e regime
- [ ] Caminho de emissão de NF-e definido

---

**Próximo:** [04 — Fotos e cadastro de produtos](04-fotos-e-cadastro-produtos.md)

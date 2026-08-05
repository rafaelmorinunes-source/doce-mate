# 2. Setup na Hostinger

Tempo total: cerca de 2 horas, sendo que boa parte é espera de propagação.
Faça na ordem.

---

## 2.1 Registrar o domínio

No painel da Hostinger (hPanel), vá em **Domínios → Obter um novo domínio**.
O plano Premium dá um domínio grátis no primeiro ano.

Sugestões, em ordem de preferência:

1. `docemate.com.br`
2. `docemateinfantil.com.br`
3. `lojadocemate.com.br`

Prefira `.com.br` a `.com`: passa mais confiança para comprador brasileiro e o
registro exige CNPJ, o que já sinaliza loja formal. Se `docemate.com.br`
estiver livre, pegue — é curto e é o nome que as pessoas já conhecem do
Instagram.

Evite hífen e número. `doce-mate.com.br` gera erro de digitação e some quando
alguém fala o endereço em voz alta.

> A propagação leva de 30 minutos a 4 horas. Siga para o passo seguinte
> enquanto espera.

---

## 2.2 Instalar o WordPress

No hPanel: **Sites → Criar ou migrar um site → Criar um novo site →
WordPress**.

A Hostinger vai perguntar se quer usar o construtor com IA. **Recuse** e peça
WordPress puro — o construtor gera um site travado no editor deles, e você
quer o WooCommerce padrão.

Anote em lugar seguro:

- URL do painel: `seudominio.com.br/wp-admin`
- Usuário administrador (não use "admin")
- Senha

Crie **dois usuários**: um administrador (você) e um para sua mãe com perfil
**Gerente da loja** (`Shop Manager`). Esse perfil deixa ela cadastrar produto e
gerenciar pedido, mas não deixa ela quebrar o site mexendo em plugin ou tema.
Isso vai te poupar muito suporte.

---

## 2.3 Ativar SSL (cadeado)

Em **Sites → seu site → Segurança → SSL**, confirme que o certificado está
ativo e que "Forçar HTTPS" está ligado.

Sem cadeado, o navegador mostra "site não seguro" e nenhum meio de pagamento
sério funciona. É gratuito e automático na Hostinger — só confirme.

---

## 2.4 Instalar o WooCommerce

No `wp-admin`: **Plugins → Adicionar novo**, buscar `WooCommerce`, instalar e
ativar.

O assistente de configuração vai pedir:

| Campo | O que responder |
|-------|-----------------|
| Endereço da loja | O endereço real da loja física em Porto Alegre |
| Setor | Moda, roupas e acessórios |
| Tipo de produto | Produtos físicos |
| Já vende em outro lugar? | Sim, presencialmente |
| Moeda | BRL (R$) |

Recuse as sugestões de plugins extras que ele oferecer (Jetpack, MailPoet,
Google Listings). Você instala depois só o que for usar — cada plugin a mais
deixa o site mais lento e o Premium tem recurso limitado.

---

## 2.5 Escolher o tema

Instale o **Storefront** (Aparência → Temas → Adicionar novo → buscar
"Storefront"). É o tema oficial do WooCommerce: leve, rápido e sem
incompatibilidade.

Não compre tema pago agora. Temas premium de marketplace costumam vir
carregados de recursos que pesam no plano Premium, e a maioria das lojas
pequenas nunca usa 90% deles.

### Identidade visual

Em **Aparência → Personalizar**, ajuste:

- **Logo** — use o mesmo do perfil do Instagram, em PNG com fundo transparente
- **Cores** — puxe da paleta que a Doce Mate já usa nas fotos do Instagram.
  Manter a mesma identidade faz o cliente que vem do Instagram reconhecer que
  chegou no lugar certo
- **Ícone do site (favicon)** — versão quadrada e simplificada do logo

Consistência com o Instagram vale mais que um site bonito e diferente.

---

## 2.6 Estrutura de páginas

O WooCommerce já cria Loja, Carrinho, Finalizar Compra e Minha Conta. Crie
manualmente estas, em **Páginas → Adicionar nova**:

- **Sobre a Doce Mate** — história da loja, foto da loja física, foto da sua
  mãe. Em negócio familiar de bairro, essa página converte de verdade
- **Contato** — WhatsApp, e-mail, endereço da loja física, horário de
  atendimento
- **Guia de tamanhos** — ver [documento 04](04-fotos-e-cadastro-produtos.md)
- **Trocas e devoluções** — texto pronto em `juridico/`
- **Política de privacidade** — texto pronto em `juridico/`
- **Política de frete e entrega** — texto pronto em `juridico/`
- **Termos de uso** — texto pronto em `juridico/`

### Obrigatório por lei no rodapé

O Decreto 7.962/2013 (Lei do E-commerce) exige que apareçam de forma
**visível em todas as páginas**:

- Razão social completa
- CNPJ
- Endereço físico
- E-mail e telefone de atendimento

Coloque tudo no rodapé em **Aparência → Widgets → Rodapé**. Não é opcional e
não é detalhe: é o que o Procon fiscaliza primeiro, e é o que faz o cliente
confiar em uma loja que ele não conhece.

---

## 2.7 Categorias do catálogo

Em **Produtos → Categorias**, monte a estrutura antes de cadastrar qualquer
peça. Refazer categoria depois com 200 produtos cadastrados é retrabalho puro.

Sugestão para vestuário infantil:

```
Bebê (0 a 24 meses)
  ├── Body e macacão
  ├── Conjunto
  ├── Saída de maternidade
  └── Acessórios

Menina (2 a 12 anos)
  ├── Vestido
  ├── Blusa
  ├── Calça e legging
  ├── Short e saia
  └── Conjunto

Menino (2 a 12 anos)
  ├── Camiseta
  ├── Bermuda
  ├── Calça
  └── Conjunto

Ocasiões
  ├── Festa
  ├── Passeio
  └── Dia a dia

Coleções
  ├── Verão
  └── Inverno
```

Um produto pode estar em várias categorias ao mesmo tempo — um vestido de
festa entra em "Menina → Vestido" e em "Ocasiões → Festa". Use isso.

---

## 2.8 Plugins essenciais

Instale **apenas estes** por enquanto:

| Plugin | Para quê |
|--------|----------|
| WooCommerce | A loja |
| Mercado Pago para WooCommerce | PIX, cartão e boleto — ver [doc 03](03-pagamentos-frete-nota-fiscal.md) |
| Melhor Envio | Cálculo e etiqueta de frete — ver [doc 03](03-pagamentos-frete-nota-fiscal.md) |
| Brazilian Market on WooCommerce | Adiciona CPF/CNPJ, bairro e CEP com máscara no checkout |
| LiteSpeed Cache | Velocidade (a Hostinger usa LiteSpeed) |

O **Brazilian Market on WooCommerce** é indispensável: o checkout padrão do
WooCommerce é americano, sem campo de CPF e sem bairro. Sem ele, você não
consegue emitir nota fiscal nem gerar etiqueta de frete corretamente.

Cada plugin extra consome recurso do plano Premium. Resista à tentação de
instalar "só para testar".

---

**Próximo:** [03 — Pagamentos, frete e nota fiscal](03-pagamentos-frete-nota-fiscal.md)

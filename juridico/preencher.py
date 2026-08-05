#!/usr/bin/env python3
"""
Preenche os documentos jurídicos com os dados de dados-da-loja.conf.

Uso:
    python3 juridico/preencher.py

Lê os modelos de juridico/*.md, substitui os {{TOKENS}} pelos valores do
arquivo de configuração e grava os textos prontos em juridico/publicar/.

Se faltar algum dado, avisa quais e não gera nada — melhor não gerar do que
gerar uma política com lacuna e publicar sem perceber.
"""

import re
import sys
from datetime import date
from pathlib import Path

BASE = Path(__file__).resolve().parent
CONFIG = BASE / "dados-da-loja.conf"
SAIDA = BASE / "publicar"

MODELOS = [
    "politica-de-troca-e-devolucao.md",
    "politica-de-privacidade.md",
    "politica-de-frete-e-entrega.md",
    "termos-de-uso.md",
]

TOKEN = re.compile(r"\{\{([A-Z_]+)\}\}")

MESES = (
    "janeiro fevereiro março abril maio junho julho "
    "agosto setembro outubro novembro dezembro"
).split()


def ler_config():
    if not CONFIG.exists():
        sys.exit(f"Não encontrei {CONFIG.name}. Ele deveria estar em juridico/.")

    dados = {}
    for numero, linha in enumerate(CONFIG.read_text(encoding="utf-8").splitlines(), 1):
        linha = linha.strip()
        if not linha or linha.startswith("#"):
            continue
        if "=" not in linha:
            sys.exit(f"{CONFIG.name}, linha {numero}: esperava 'CHAVE = valor'.")
        chave, _, valor = linha.partition("=")
        dados[chave.strip()] = valor.strip()
    return dados


def main():
    dados = ler_config()

    if not dados.get("DATA_ATUALIZACAO"):
        hoje = date.today()
        dados["DATA_ATUALIZACAO"] = f"{hoje.day} de {MESES[hoje.month - 1]} de {hoje.year}"

    # Um único e-mail costuma servir para tudo numa loja pequena.
    if not dados.get("EMAIL_PRIVACIDADE") and dados.get("EMAIL"):
        dados["EMAIL_PRIVACIDADE"] = dados["EMAIL"]

    faltando = {}
    for nome in MODELOS:
        caminho = BASE / nome
        if not caminho.exists():
            sys.exit(f"Não encontrei o modelo {nome}.")
        for token in TOKEN.findall(caminho.read_text(encoding="utf-8")):
            if not dados.get(token):
                faltando.setdefault(token, []).append(nome)

    if faltando:
        print("Faltam dados em dados-da-loja.conf:\n")
        for token in sorted(faltando):
            arquivos = ", ".join(sorted(set(faltando[token])))
            print(f"  {token:<22} usado em {arquivos}")
        print("\nPreencha esses campos e rode de novo. Nada foi gerado.")
        return 1

    SAIDA.mkdir(exist_ok=True)
    for nome in MODELOS:
        texto = (BASE / nome).read_text(encoding="utf-8")
        texto = TOKEN.sub(lambda m: dados[m.group(1)], texto)

        sobrou = TOKEN.findall(texto)
        if sobrou:
            sys.exit(f"{nome}: sobrou {', '.join(sobrou)} depois da substituição.")

        (SAIDA / nome).write_text(texto, encoding="utf-8")
        print(f"  publicar/{nome}")

    print(f"\n4 documentos prontos em juridico/publicar/, sem lacunas.")
    print("Copie cada um para uma página do WordPress.")
    print("\nAntes de ir ao ar, peça para um advogado revisar.")
    return 0


if __name__ == "__main__":
    sys.exit(main())

# Site institucional do Ordik ERP

Site público do **Ordik ERP**. O sistema fica no repositório `Erp-Ordik`, branch `erp-legado`; este aqui é independente.

Stack: Laravel 13, Blade, Tailwind CSS 4, Vue 3 nos componentes interativos, Vite e Pest.

## Rodando localmente

Requisitos: PHP 8.3+ (extensões `intl`, `zip`, `pdo_sqlite`), Composer e Node 20.19+.

```bash
composer setup
composer dev   # http://localhost:8000
```

## Testes

```bash
./vendor/bin/pest
```

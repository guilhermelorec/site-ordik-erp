# Site institucional do Ordik ERP

Site público do **Ordik ERP**, sistema de gestão on-premise para pequenas e médias empresas. O sistema fica no repositório `Erp-Ordik`, branch `erp-legado`; este site é independente.

- **Stack:** Laravel 13, Blade, Tailwind CSS 4, Vite, Filament 5 no painel e Pest nos testes.
- **Páginas:** `/`, `/funcionalidades`, `/pdv`, `/para/{lojas,oficinas,distribuidoras}`, `/implantacao`, `/empresa`, `/blog`, `/contato`, `/privacidade`, `/termos`, `sitemap.xml` e `robots.txt`.
- **Admin:** `/admin` lista os leads, com filtro por status e data e exportação CSV.

## Rodando localmente

Requisitos: PHP 8.3+ (extensões `intl`, `zip`, `pdo_sqlite`), Composer e Node 20.19+.

```bash
composer setup
php artisan db:seed   # cria o admin com ADMIN_EMAIL e ADMIN_PASSWORD do .env
composer dev          # http://localhost:8000
```

Com `MAIL_MAILER=log`, os e-mails de lead aparecem em `storage/logs/laravel.log`.

## Rodando com Docker

A imagem usa FrankenPHP e PostgreSQL.

```bash
cp .env.example .env
php artisan key:generate   # ou preencha APP_KEY manualmente
# ajuste ADMIN_EMAIL, ADMIN_PASSWORD e, se quiser, APP_PORT
docker compose up -d --build
```

## Deploy na Vercel

O `vercel.json` usa o runtime comunitário `vercel-php` (PHP 8.3) na região `gru1`. A Vercel não roda `artisan` no build, então:

- os assets do Filament ficam versionados em `public/`: rode `php artisan filament:assets` ao atualizar o Filament;
- as migrations rodam fora da Vercel, apontando para o banco de produção: `DB_CONNECTION=pgsql DB_URL=... php artisan migrate --force`.

Defina como variáveis do projeto: `APP_KEY`, `APP_URL`, `DB_URL` (ou `DATABASE_URL`), `LEADS_NOTIFY_EMAIL`, `ORDIK_CONTACT_EMAIL` e as `MAIL_*` quando houver SMTP.

## Variáveis do projeto

| Variável | Uso |
|---|---|
| `ORDIK_CONTACT_EMAIL` | E-mail público no rodapé e no JSON-LD |
| `LEADS_NOTIFY_EMAIL` | Quem recebe cada novo lead (vazio = não envia) |
| `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PASSWORD` | Admin criado pelo seeder |
| `APP_PORT` | Porta do host no `docker compose` |

Em produção, use `APP_ENV=production` e `APP_URL` com o domínio real. Fora de produção, o `robots.txt` bloqueia a indexação.

## Conteúdo

- **Módulos, segmentos, tabela da home e FAQ:** `config/ordik.php`. Anuncie só o que o sistema faz hoje.
- **Blog:** um `.md` por post em `resources/content/blog/`, com `title`, `date` e `summary` no front matter. O nome do arquivo vira o slug.
- **Capturas:** `public/images/produto/`. Use sempre dados de demonstração.
- **Textos legais:** `resources/views/pages/legal/`.

## Testes

```bash
./vendor/bin/pest
```

O GitHub Actions roda o build dos assets e os testes em cada push e pull request.

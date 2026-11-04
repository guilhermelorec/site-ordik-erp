<?php

return [
    'contact_email' => env('ORDIK_CONTACT_EMAIL', 'comercial@ordik.com.br'),

    // Deploys de pré-visualização da Vercel respondem no próprio endereço, não em APP_URL.
    'force_root_url' => env('VERCEL_ENV', 'production') === 'production',

    'leads_notify_email' => env('LEADS_NOTIFY_EMAIL'),

    'admin' => [
        'name' => env('ADMIN_NAME', 'Admin Ordik'),
        'email' => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    // Conteúdo vindo de docs/DOCUMENTACAO-DO-SISTEMA.md do Erp-Ordik (branch erp-legado).
    // Não anuncie aqui nada que esteja fora do que o sistema faz hoje.
    'modules' => [
        'crm' => [
            'name' => 'CRM',
            'keyword' => 'CRM de vendas',
            'summary' => 'Leads, funil em kanban, propostas e follow-up de cada vendedor.',
            'description' => 'Acompanhe cada negócio do primeiro contato à venda. Quando a oportunidade é ganha, ela vira um pedido sem digitar nada de novo.',
            'image' => 'crm-kanban',
            'alt' => 'Kanban do CRM do Ordik com oportunidades nas etapas de prospecção, qualificação e proposta',
            'features' => [
                'Leads com origem' => 'Registre de onde veio cada contato: site, indicação, telefone, evento ou parceiro.',
                'Kanban' => 'Arraste a oportunidade entre as etapas. O histórico guarda quem mudou e quando.',
                'Propostas' => 'Monte a proposta com produtos, condições de pagamento, prazo de entrega e validade.',
                'Atividades' => 'Veja ligações, visitas e tarefas de hoje, as atrasadas e as próximas.',
                'Alertas comerciais' => 'O painel avisa sobre follow-up atrasado, negócio parado e fechamento próximo.',
                'Carteira por vendedor' => 'O vendedor vê os próprios negócios. Gerente e administrador veem o time.',
            ],
        ],
        'vendas' => [
            'name' => 'Vendas',
            'keyword' => 'pedidos de venda',
            'summary' => 'Do rascunho à confirmação, com baixa de estoque e cobrança automáticas.',
            'description' => 'O pedido fica aberto para conferência. Ao confirmar, os itens saem do estoque, a conta a receber é criada e a nota interna fica pronta para impressão.',
            'image' => null,
            'alt' => null,
            'features' => [
                'Pedido em rascunho' => 'Confira itens, descontos e totais antes de confirmar. O estoque só muda na confirmação.',
                'Confirmação com um clique' => 'Baixa o estoque, gera a conta a receber e abre a nota para impressão.',
                'Venda vinda do CRM' => 'A oportunidade ganha gera o pedido com cliente e itens preenchidos.',
                'Nota e cupom internos' => 'Imprima e reimprima o documento de qualquer venda confirmada.',
            ],
        ],
        'estoque' => [
            'name' => 'Estoque',
            'keyword' => 'controle de estoque',
            'summary' => 'Saldo calculado pelas movimentações, com alerta de estoque mínimo.',
            'description' => 'Ninguém digita saldo à mão. Compras, vendas, ordens de serviço e ajustes registram cada entrada e saída com data, quantidade e responsável.',
            'image' => 'estoque',
            'alt' => 'Tela de movimentações de estoque do Ordik com entradas, saídas, saldo e responsável',
            'features' => [
                'Histórico completo' => 'Cada entrada, saída e ajuste fica registrado com saldo resultante e responsável.',
                'Estoque mínimo' => 'Produtos abaixo do mínimo aparecem em destaque na lista e no dashboard.',
                'Catálogo organizado' => 'Código interno, código de barras, categoria, marca, preço de compra e de venda.',
                'Excel e PDF' => 'Exporte as movimentações para conferir ou enviar à contabilidade.',
            ],
        ],
        'compras' => [
            'name' => 'Compras',
            'keyword' => 'gestão de compras',
            'summary' => 'Pedido ao fornecedor com aprovação, recebimento e conta a pagar.',
            'description' => 'Só o que foi aprovado pode ser recebido. Ao receber, a mercadoria entra no estoque e a conta a pagar aparece no financeiro.',
            'image' => null,
            'alt' => null,
            'features' => [
                'Aprovação por perfil' => 'Quem aprova precisa de permissão própria, separada de quem cria o pedido.',
                'Recebimento integrado' => 'Cada item entra no estoque e nasce uma conta a pagar no valor do pedido.',
                'Fornecedores' => 'Cadastro único, usado nos pedidos e nas contas a pagar.',
            ],
        ],
        'ordens-de-servico' => [
            'name' => 'Ordens de serviço',
            'keyword' => 'sistema de ordem de serviço',
            'summary' => 'Abertura, execução e entrega, com peças, mão de obra e cobrança.',
            'description' => 'Para oficinas e assistências. Registre equipamento e problema, acompanhe o serviço e, na entrega, as peças saem do estoque e a cobrança é gerada.',
            'image' => 'ordens-de-servico',
            'alt' => 'Lista de ordens de serviço do Ordik com cliente, equipamento, total e status',
            'features' => [
                'Status do serviço' => 'Aberta, em execução, concluída e entregue, sempre nessa ordem.',
                'Diagnóstico' => 'Guarde o problema relatado e o diagnóstico técnico na mesma ficha.',
                'Peças e mão de obra' => 'O total soma mão de obra e peças, menos o desconto.',
                'Baixa na entrega' => 'As peças saem do estoque e a conta a receber é criada ao entregar.',
            ],
        ],
        'pdv' => [
            'name' => 'PDV',
            'keyword' => 'frente de caixa',
            'summary' => 'Frente de caixa para teclado, com leitor de código de barras e pagamento misto.',
            'description' => 'O operador trabalha só no terminal, sem acesso ao resto do ERP. Cada venda atualiza estoque e financeiro na hora. Não existe caixa paralelo.',
            'image' => 'pdv',
            'alt' => 'Terminal de frente de caixa do Ordik com quatro itens lançados e total de R$ 334,60',
            'features' => [
                'Leitor de código de barras' => 'Leia o produto ou digite código e nome. Preço e estoque aparecem na hora.',
                'Atalhos de teclado' => 'Finalize com F2, identifique CPF ou CNPJ com F3 e faça sangria com F4.',
                'Pagamento misto' => 'Combine dinheiro, cartão de crédito, débito e Pix na mesma venda.',
                'Sessão de caixa' => 'Abertura, sangria, suprimento e fechamento com o valor contado na gaveta.',
                'Vários terminais' => 'Cadastre os caixas de cada filial. O terminal pode rodar em outro computador da rede.',
            ],
        ],
        'financeiro' => [
            'name' => 'Financeiro',
            'keyword' => 'controle financeiro',
            'summary' => 'Contas a pagar e receber, fluxo de caixa e DRE gerencial.',
            'description' => 'As contas nascem das vendas, compras e ordens de serviço. Você baixa o que foi pago e vê o resultado por categoria e centro de custo.',
            'image' => 'contas-a-receber',
            'alt' => 'Tela de contas a receber do Ordik com valor, vencimento, data de recebimento e status',
            'features' => [
                'Contas a pagar e receber' => 'Títulos automáticos ou lançados à mão, com baixa por data.',
                'Fluxo realizado' => 'O que entrou, o que saiu e o saldo de qualquer período.',
                'Fluxo projetado' => 'O que vai vencer, a pagar e a receber, com o saldo previsto.',
                'DRE gerencial' => 'Receitas e despesas por categoria, com o resultado do período.',
                'Centros de custo' => 'Separe loja, oficina e administrativo para ver onde o dinheiro vai.',
            ],
        ],
        'gestao' => [
            'name' => 'Gestão e acessos',
            'keyword' => 'dashboard de gestão',
            'summary' => 'Dashboard por empresa e filial, com permissões por perfil.',
            'description' => 'O dashboard mostra faturamento, ticket médio, contas e estoque mínimo. Cada pessoa acessa só o que o perfil dela permite.',
            'image' => 'dashboard',
            'alt' => 'Dashboard do Ordik com faturamento, ticket médio, contas a receber e a pagar e gráficos mensais',
            'features' => [
                'Dashboard executivo' => 'Faturamento, ticket médio, saldo, contas e produtos abaixo do mínimo.',
                'Empresas e filiais' => 'Olhe o grupo inteiro, uma empresa ou uma filial específica.',
                'Seis perfis prontos' => 'Administrador, gerente, vendedor, financeiro, estoquista e operador de caixa.',
                'Permissões detalhadas' => 'Consultar, criar, confirmar e receber são direitos separados.',
            ],
        ],
    ],

    // Abas da home: cada frente mostra uma tela real e leva aos módulos dela.
    'pillars' => [
        'Gerir' => [
            'title' => 'Gestão ligada do estoque ao financeiro',
            'text' => 'Acompanhe faturamento, contas e estoque mínimo em um só painel, por filial ou pelo grupo inteiro.',
            'image' => 'dashboard',
            'alt' => 'Dashboard do Ordik com faturamento, ticket médio, contas e gráficos mensais',
            'modules' => ['gestao', 'estoque', 'compras', 'financeiro'],
        ],
        'Vender' => [
            'title' => 'Do primeiro contato ao caixa',
            'text' => 'Conduza negócios no CRM, confirme pedidos e venda no balcão. Tudo cai no mesmo estoque e no mesmo financeiro.',
            'image' => 'crm-kanban',
            'alt' => 'Kanban do CRM do Ordik com oportunidades por etapa',
            'modules' => ['crm', 'vendas', 'pdv'],
        ],
        'Atender' => [
            'title' => 'Serviços do início à entrega',
            'text' => 'Registre equipamento e problema, acompanhe a execução e entregue com peças baixadas e cobrança gerada.',
            'image' => 'ordens-de-servico',
            'alt' => 'Lista de ordens de serviço do Ordik com cliente, equipamento, total e status',
            'modules' => ['ordens-de-servico'],
        ],
    ],

    'benefits' => [
        ['heroicon-o-link', 'Um cadastro para tudo', 'Cliente, produto e fornecedor são cadastrados uma vez e usados em todos os módulos.'],
        ['heroicon-o-wifi', 'Funciona sem internet', 'O sistema roda na sua rede local. Se a conexão cair, a operação continua.'],
        ['heroicon-o-lock-closed', 'Seus dados com você', 'Banco de dados e backups ficam no computador da sua empresa.'],
        ['heroicon-o-user-group', 'Cada um vê o que precisa', 'Seis perfis prontos e permissões separadas para consultar, criar e confirmar.'],
    ],

    // O que muda em cada documento. Linhas da tabela da home.
    'chain' => [
        ['Confirma uma venda', 'Saída dos itens', 'Conta a receber criada'],
        ['Vende no PDV', 'Saída dos itens', 'Conta criada e já quitada'],
        ['Recebe uma compra', 'Entrada dos itens', 'Conta a pagar criada'],
        ['Entrega uma ordem de serviço', 'Saída das peças', 'Conta a receber do total'],
    ],

    'solutions' => [
        'lojas' => [
            'name' => 'Lojas e varejo',
            'short' => 'Caixa, estoque e financeiro ligados',
            'title' => 'Sistema para loja com PDV e controle de estoque',
            'headline' => 'A venda do balcão entra direto na gestão da loja',
            'description' => 'Sistema para loja com frente de caixa, código de barras, controle de estoque e financeiro no mesmo lugar. Instalado na sua empresa, funciona sem internet.',
            'intro' => 'O caixa lê o código de barras, recebe do jeito que o cliente quiser e imprime o cupom. Estoque e financeiro acompanham cada venda, sem conferência no fim do dia.',
            'modules' => ['pdv', 'estoque', 'financeiro'],
            'image' => 'pdv',
            'alt' => 'Terminal de frente de caixa do Ordik com itens lançados',
            'imageHeight' => 1000,
            'journey' => [
                'Abra o caixa com o fundo de troco.',
                'Leia os produtos e identifique o CPF se o cliente pedir.',
                'Receba em dinheiro, cartão, Pix ou combinando as formas.',
                'Imprima o cupom. Estoque e financeiro já mudaram.',
                'Feche o caixa conferindo o dinheiro da gaveta.',
            ],
        ],
        'oficinas' => [
            'name' => 'Oficinas e assistências',
            'short' => 'Ordens de serviço com peças e cobrança',
            'title' => 'Sistema de ordem de serviço para oficina e assistência técnica',
            'headline' => 'Da reclamação do cliente à cobrança, na mesma ordem de serviço',
            'description' => 'Sistema de ordem de serviço para oficinas e assistências técnicas: equipamento, diagnóstico, peças, mão de obra, baixa de estoque e cobrança na entrega.',
            'intro' => 'Registre o equipamento e o problema, acompanhe quem está trabalhando em quê e entregue com tudo calculado. As peças usadas saem do estoque e a cobrança vai para o financeiro.',
            'modules' => ['ordens-de-servico', 'estoque', 'financeiro'],
            'image' => 'ordens-de-servico',
            'alt' => 'Lista de ordens de serviço do Ordik com status e valores',
            'imageHeight' => 1111,
            'journey' => [
                'Abra a OS com o equipamento e a reclamação.',
                'Inicie o serviço e lance as peças usadas.',
                'Conclua e registre o diagnóstico.',
                'Entregue: as peças saem do estoque e a cobrança é criada.',
            ],
        ],
        'distribuidoras' => [
            'name' => 'Distribuidoras e atacado',
            'short' => 'Funil comercial, compras e pedidos',
            'title' => 'ERP para distribuidora com CRM, compras e estoque',
            'headline' => 'Venda com funil comercial e reponha com controle',
            'description' => 'ERP para distribuidoras e atacado: CRM com funil de vendas, propostas, pedidos, compras com aprovação, estoque e contas a pagar e receber integrados.',
            'intro' => 'Quando a venda depende de proposta e retorno, o CRM mostra em que pé cada negócio está. A oportunidade ganha vira pedido, e as compras mantêm o estoque abastecido com aprovação.',
            'modules' => ['crm', 'compras', 'vendas'],
            'image' => 'crm-kanban',
            'alt' => 'Kanban de oportunidades do CRM do Ordik',
            'imageHeight' => 1111,
            'journey' => [
                'Registre o lead e as primeiras conversas.',
                'Converta em oportunidade e monte a proposta.',
                'Marque como ganha e gere o pedido de venda.',
                'Confirme: o estoque sai e a conta a receber entra.',
                'Reponha com pedido de compra aprovado e recebido.',
            ],
        ],
    ],

    'faq' => [
        'Precisa de internet para funcionar?' => 'Não no dia a dia. O Ordik fica instalado em um computador da sua empresa, e os outros acessam pela rede local.',
        'Onde ficam os meus dados?' => 'No computador ou servidor da sua empresa. O backup diário pode ser agendado na instalação.',
        'O Ordik emite nota fiscal?' => 'Ainda não. Hoje o sistema imprime nota e cupom internos, com CPF ou CNPJ do cliente, sem envio à SEFAZ. A emissão de NF-e e NFC-e está no roteiro do produto.',
        'Aceita Pix no caixa?' => 'O operador registra dinheiro, cartão e Pix, e pode combinar as formas na mesma venda. A cobrança Pix integrada ao banco ainda não está disponível.',
        'Atende mais de uma empresa ou filial?' => 'Sim. Você cadastra várias empresas e filiais, e cada usuário trabalha só no recorte dele. Quem administra pode ver o grupo inteiro.',
        'Qual computador eu preciso?' => 'Windows 10 ou 11 de 64 bits, 8 GB de memória e 10 GB livres em disco. Para servir outros computadores na rede, recomendamos 16 GB.',
        'Quanto custa?' => 'Depende do número de unidades, de terminais e da implantação. Enviamos a proposta depois da demonstração.',
    ],
];

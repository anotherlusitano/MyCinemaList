<p align="center"><img src="https://github.com/user-attachments/assets/2768e6b5-7cc2-47cf-aea5-5441e5c26432" width="400" alt="MyCinemaList Logo"></p>

<p align="center">
    Uma aplicação web em Laravel que permite organizar, avaliar e acompanhar listas personalizadas dos teus filmes favoritos de forma simples e intuitiva.
</p>

## ℹ️ About

O **MyCinemaList** é uma plataforma pensada para os verdadeiros amantes de cinema, que querem uma experiência completa e personalizada na organização e partilha das suas opiniões sobre filmes. Aqui, o utilizador não só gere listas de filmes com notas e estados de visualização, como também cria reviews com recomendações detalhadas, podendo expressar sentimentos positivos, negativos ou mistos.

A plataforma permite ainda que os utilizadores criem e personalizem os seus perfis, acompanhem as suas pessoas e filmes favoritos e explorem os perfis de outros utilizadores, actores, realizadores e outras pessoas que participam nos filmes. Para garantir uma boa gestão do conteúdo, existe um painel de administração robusto, onde os administradores têm controlo total sobre filmes, pessoas e reviews.

No MyCinemaList, a avaliação de filmes é transparente e social: qualquer utilizador pode consultar a nota média e a percentagem de recomendações, dando uma visão clara e comunitária do que vale cada título.

---

## ✨ Features

- **Reviews detalhadas:** Os utilizadores podem criar reviews onde expressam se recomendam, não recomendam ou têm sentimentos mistos sobre um filme.  
- **Listas personalizadas:** Cria listas onde podes dar uma nota de 1 a 10 a cada filme, assinalar se já viste, abandonaste ou pretendes ver.  
- **Favoritos:** Marca pessoas e filmes favoritos para aceder facilmente ao que mais gostas.  
- **Gestão de perfil:** Permite alterar username, password e imagem de perfil de forma simples e segura.  
- **Exploração pública:** Tanto convidados como utilizadores registados podem ver perfis, páginas de filmes, reviews e pesquisar filmes, pessoas e utilizadores.  
- **Visualização completa:** Consulta todas as reviews, listas e favoritos de qualquer utilizador.  
- **Painel de administração:** Administradores têm poderes para criar, editar e apagar filmes, pessoas (staff) e reviews, garantindo o controlo do conteúdo da plataforma.  
- **Estatísticas de filmes:** Na página de cada filme podes ver a nota média e a percentagem de utilizadores que recomendam, não recomendam ou têm sentimentos indiferentes.

---

## 🚀 Setup

1. **Clonar o repositório**

```bash
git clone https://github.com/anotherlusitano/MyCinemaList.git
cd MyCinemaList
```

2. **Configurar o ambiente**

```bash
cp .env.example .env
php artisan key:generate
```

3. **Instalar as dependências**

```
composer install
npm install
```

4. **Criar a base de dados e iniciar a aplicação**

```bash
php artisan migrate --seed
php artisan serve
```

---

## Informações adicionais

Ao dar `seed` à base de dados, vai gerar duas contas predefinidas:
- `test@gmail.com`  - conta de um utilizador comum
- `admin@gmail.com` - conta de um administrador

E a password é `password`.

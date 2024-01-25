<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="/src/assets/css/global.css" rel="stylesheet" />
</head>

<body>
  <section>
    <div class="dashboard">
      <button data-modal-trigger="sample-modal2" class="button dashboard-btn">Ajouter un utilisateur</a>
    </div>
    <div class="modal" data-modal-name="sample-modal2" data-modal-dismiss>
      <div class="modal__dialog">
        <header class="modal__header">
          <h3 class="modal__title">Ajouter un nouvel utilisateur</h3>
        </header>
        <div class="modal__content">
          <form method="POST" action="/src/index.php">
            <input id="actionInput" type="hidden" name="action" value="createUser">
            <input id="idUser" type="hidden" name="action" value="0">
            <div class="form-group">
              <label for="lastname">Nom:</label>
              <input type="text" id="lastname" name="lastname" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="firstname">Prénom:</label>
              <input type="text" id="firstname" name="firstname" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="button dashboard-btn">Ajouter</button>
          </form>
        </div>
      </div>
    </div>
  </section>
  <div class="container">
    <aside class="sidebar">
      <ul class="menu-list">
        <li>
          <div class="menu-container">
            <button class="icon" id="menu">
              <img src="./assets/images/menu.svg" alt="menu" />
            </button>
          </div>
        </li>
        <li>
          <button class="icon" id="search">
            <img src="./assets/images/search.svg" alt="search" />
          </button>
        </li>
        <li>
          <button class="icon" id="users">
            <img src="./assets/images/user.svg" alt="users" />
          </button>
        </li>
        <li>
          <button class="icon" id="settings">
            <img src="./assets/images/settings.svg" alt="settings" />
          </button>
        </li>
      </ul>
      <div class="logout-container">
        <button class="icon-logout">
          <img src="./assets/images/log-out.svg" alt="logout" />
        </button>
      </div>
    </aside>
    <section class="main">
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>firstname</th>
              <th>lastname</th>
              <th>email</th>
              <th>actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td><?= $user->getFirstname() ?></td>
                <td><?= $user->getLastname() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td>
                  <button class="edit" data-id-user="<?= $user->getId() ?>">Modifier</button>
                  <button class="delete" date-id-user="<?= $user->getId() ?>">Supprimer</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>


</body>
<script type="text/javascript" src="/src/assets/js/sidebar.js"></script>
<script type="text/javascript" src="/src/assets/js/modal.js"></script>
<script type="text/javascript" src="/src/assets/js/admin.js"></script>
</html>
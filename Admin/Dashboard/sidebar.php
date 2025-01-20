  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Utilisateur" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person"></i><span>Utilisateur</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Utilisateur" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./viewuser.php">
              <i class="bi bi-circle"></i><span>View Utilisateur</span>
            </a>
          </li>
         
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Requête" data-bs-toggle="collapse" href="#">
        <i class="bi bi-app-indicator"></i><span>Requête</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Requête" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./viewrequest.php">
              <i class="bi bi-circle"></i><span>View Requête</span>
            </a>
          </li>
         
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Usecasegénéré" data-bs-toggle="collapse" href="#">
        <i class="bi bi-chat-quote"></i><span>Use case généré</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Usecasegénéré" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./viewuseenginecase.php">
              <i class="bi bi-circle"></i><span>View Use case généré</span>
            </a>
          </li>
         
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Résultatattendu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-clipboard2-data"></i><span>Résultat attendu</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Résultatattendu" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="./viewprompt_2.php">
              <i class="bi bi-circle"></i><span>View Résultat attendu</span>
            </a>
          </li>
         
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Exemplederésultat" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layers"></i><span>Exemple de résultat</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Exemplederésultat" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./viewprompt_3.php">
              <i class="bi bi-circle"></i><span>View Exemple de résultat</span>
            </a>
          </li>
         
        </ul>
      </li>
    </ul>

  </aside><!-- End Sidebar-->
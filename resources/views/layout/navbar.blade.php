<style>
   .app-header {
       position: relative;
       top: 0;
       width: 100%;
       background: #fff;
       box-shadow: 0 2px 4px rgba(0,0,0,0.1);
   }

   .user-profile {
       display: flex;
       align-items: center;
       gap: 12px;
       padding: 8px 15px;
   }

   .user-avatar {
       width: 40px;
       height: 40px;
       border-radius: 50%;
       background: #f0f0f0;
       overflow: hidden;
       border: 2px solid #e0e0e0;
   }

   .user-avatar img {
       width: 100%;
       height: 100%;
       object-fit: cover;
   }

   .user-info {
       display: flex;
       flex-direction: column;
   }

   .user-role {
       font-size: 16px;
       font-weight: 600;
       color: #0066cc; /* Diubah menjadi warna biru */
       text-transform: capitalize;
   }
</style>

<div class="body-wrapper" style="padding-top: 70px;">
   <header class="app-header">
       <nav class="navbar navbar-expand-lg navbar-light">
           <div class="container-fluid">
               <ul class="navbar-nav">
                   <li class="nav-item d-block d-xl-none">
                       <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                           <i class="ti ti-menu-2"></i>
                       </a>
                   </li>
               </ul>

               <!-- Profil Pengguna -->
               @auth
               <div class="user-profile ms-auto">
                   <div class="user-avatar">
                       <img src="https://png.pngtree.com/png-clipart/20230409/original/pngtree-admin-and-customer-service-job-vacancies-png-image_9041264.png" alt="Profile Picture">
                   </div>
                   <div class="user-info">
                       <span class="user-role">{{ Auth::user()->nama }}</span>
                   </div>
               </div>
               @endauth
           </div>
       </nav>
   </header>
   <div class="main-content">
       <!-- Konten Anda -->
   </div>
</div>

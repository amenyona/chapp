<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            @if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise())
            <li>
                <a class='bx bx-flag' href="{{route('pays.index')}}" class="waves-effect"  style="font-size: 1.5em;">
                    <span key="t-dashboards">Pays</span>
                </a>
            </li>
            @endif

            @if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise())
            <li>
                <a class='bx bx-layer' href="{{route('roles.index')}}" class="waves-effect"  style="font-size: 1.5em;">
                    <span key="t-dashboards">Rôles</span>
                </a>
            </li>
            @endif
            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id))
            <li>
                <a class='bx bx-home' href="{{route('eglise.index')}}" class="waves-effect"  style="font-size: 1.5em;">
                    <span key="t-dashboards">Eglises</span>
                </a>
            </li>
            @endif
            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id))
            <li>
                <a class='bx bx-phone-call' href="{{route('telephone.index')}}" class="waves-effect"  style="font-size: 1.5em;">
                    <span key="t-dashboards">Téléphones</span>
                </a>
            </li>
            @endif
            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id))
            <li>
                <a class='bx bx-user' href="{{route('auth.listeusers')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Utilisateurs</span>                  
                </a>
                
            </li>
            @endif


            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) )
            <li>
                <a class="bx bx-list-ul" href="{{route('article.index')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Publier Articles</span>                  
                </a>
            </li>
            @endif

            
            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) )
            <li>
                <a class="bx bx-bookmark-minus" href="{{route('annonce.index')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Créer Annonces</span>                  
                </a>
            </li>
            @endif
            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id))
            <li>
                <a class="bx bx-message-rounded" href="{{route('commentaire.index')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Voir Commentaires</span>                  
                </a>
            </li>
            @endif
            
            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id))
            <li>
                <a class="bx bx-photo-album" href="{{route('repertoire.index')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Nos Documents</span>                  
                </a>
            </li>
            @endif

            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) || renvoiRoleUserSimple(Auth::user()->id))
            <li>
                <a class="bx bx-git-merge" href="{{route('anonce.consultAnnonce')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Annonces Actives</span>                  
                </a>
            </li>
            @endif

            

            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) || renvoiRoleUserSimple(Auth::user()->id))
            <li>
                <a class="bx bx-history" href="{{route('anonce.consultAnnonceExpiree')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Annonces Expirées</span>                  
                </a>
            </li>
            @endif

            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) || renvoiRoleUserSimple(Auth::user()->id))
            <li>
                <a class="bx bx-slider-alt" href="{{route('article.listArticle')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Voir Actualités</span>                  
                </a>
            </li>
            @endif
            
            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) || renvoiRoleUserSimple(Auth::user()->id))
            <li>
                <a class="bx bx-message-alt" href="{{route('commentaire.mescommentaires')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Mes Commentaires</span>                  
                </a>
            </li>
            @endif
            @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) || renvoiRoleUserSimple(Auth::user()->id))
            <li>
                <a class="bx bx-home" href="{{route('messe.index')}}" class="waves-effect" style="font-size: 1.5em;">
                    <span key="t-dashboards">Les Messes</span>                  
                </a>
            </li>
            @endif


          



        </ul>
    </div>
    <!-- Sidebar -->
</div>
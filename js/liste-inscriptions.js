$(document).ready(function(){
    var request = $.post('../ajax/liste-inscrptions-filtree.php', {}, 'html');

    request.done(function(data) {
        $("#liste-inscriptions").empty().html(data);
    });

    request.fail(function(jqXHR) {
        console.log(jqXHR.status + " " + jqXHR.statusText);
        var msgErr = "La requête a échoué : contactez l'administrateur";
        $("#liste-inscriptions").empty().html(msgErr);
    });

    $('#filtre-matricule').on('change', function(){
        afficheInscriptions();
    });

    $('#filtre-statut').on('change', function(){
        afficheInscriptions();
    });
    $('#filtre-organisateur').on('change', function(){
        afficheInscriptions();
    });
    $('#filtre-formation').on('input', function(){
        afficheInscriptions();
    });

    $('#effacer-filtres').on('click', function(){
        $('#filtre-matricule').val('');
        $('#filtre-statut').val(false);
        $('#filtre-organisateur').val(false);
        $('#filtre-formation').val(false);
    });

    function afficheInscriptions() {
        var leMatricule  = $('#filtre-matricule').val();
        var leStatut = $('#filtre-statut option:selected').val();
        var lOrganisateur = $('#filtre-organisateur option:selected').val();
        var laFormation = $('#filtre-formation option:selected').val();

        var request = $.post(
            '../ajax/liste-inscrptions-filtree.php',
            {
                filtreMatricule: leMatricule,
                idStatut: leStatut,
                idOrganisateur:lOrganisateur,
                idFormation: laFormation
            },
            'html'
        );

        request.done(function(data){
            $("#liste-inscriptions").empty().html(data);
        });

        request.fail(function(jqXHR) {
            console.log(jqXHR.status + " " + jqXHR.statusText);
            $("#liste-inscriptions").empty()
                .html("La requête a échoué : contactez l'administrateur");
        })
    };
});


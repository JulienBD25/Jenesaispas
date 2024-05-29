async function fetchDoctors() {
    return [
        { Nom: "Martin", Prenom: "Alice", Email: "alice.martin@example.com", ID_Medecin: 1, CV: "AliceMartin-en-MedecineGenerale.jpg", Photo: "MedecineGeneral2.jpg", Specialite: "Médecine générale" },
        { Nom: "Dupont", Prenom: "Benoit", Email: "benoit.dupont@example.com", ID_Medecin: 2, CV: "BenoitDupont-en-MedecineGenerale.jpg", Photo: "MedecineGeneral.jpg", Specialite: "Médecine générale" },
        { Nom: "Moreau", Prenom: "Clara", Email: "clara.moreau@example.com", ID_Medecin: 3, CV: "ClaraMoreau-en-MedecineGenerale.jpg", Photo: "MedecineGeneral3.jpg", Specialite: "Médecine générale" },
        { Nom: "Leroy", Prenom: "David", Email: "david.leroy@example.com", ID_Medecin: 4, CV: "DavidLeroy-en-MedecineGenerale.jpg", Photo: "MedecineGeneral4.jpg", Specialite: "Médecine générale" },
        { Nom: "Robert", Prenom: "Emma", Email: "emma.robert@example.com", ID_Medecin: 5, CV: "EmmaRobert-en-MedecineGenerale.jpg", Photo: "MedecinFemme.jpg", Specialite: "Médecine générale" },
        { Nom: "Dupont", Prenom: "Jean", Email: "jean.dupont@example.com", ID_Medecin: 6, CV: "Médecin-en-Addictologie.jpg", Photo: "MedecinGastro.jpg", Specialite: "Addictologie" },
        { Nom: "Martin", Prenom: "Pierre", Email: "pierre.martin@example.com", ID_Medecin: 7, CV: "Médecin-en-Andrologie.jpg", Photo: "MedecinAndrologie.jpg", Specialite: "Andrologie" },
        { Nom: "Leblan", Prenom: "Marie", Email: "marie.leblan@example.com", ID_Medecin: 8, CV: "Médecin-en-Cardiologie.jpg", Photo: "MedecinCardiologie.jpg", Specialite: "Cardiologie" },
        { Nom: "Durand", Prenom: "Sophie", Email: "sophie.durand@example.com", ID_Medecin: 9, CV: "Médecin-en-Dermatologie.jpg", Photo: "MedecinDermatologie.jpg", Specialite: "Dermatologie" },
        { Nom: "Petit", Prenom: "Claude", Email: "claude.petit@example.com", ID_Medecin: 10, CV: "Médecin-en-Gastro.jpg", Photo: "MedecinGastro.jpg", Specialite: "Gastro-Hépato-Entérologie" },
        { Nom: "Moreau", Prenom: "Alice", Email: "alice.moreau@example.com", ID_Medecin: 11, CV: "MédecinGynecologie.jpg", Photo: "MedecinGynecologie.jpg", Specialite: "Gynécologie" },
        { Nom: "Lefèvre", Prenom: "Marc", Email: "marc.lefevre@example.com", ID_Medecin: 12, CV: "Médecin-en-IST.jpg", Photo: "MedecinIST.jpg", Specialite: "I.S.T." },
        { Nom: "Bernard", Prenom: "Lucie", Email: "lucie.bernard@example.com", ID_Medecin: 13, CV: "Médecin-en-Osteopathie.jpg", Photo: "MedecinOsteopathie.jpg", Specialite: "Ostéopathie" }
    ];
}

async function fetchServices() {
    return [
        { id: 1, nom_service: "Test sanguin complet", description: "Analyse détaillée de votre sang." },
        { id: 2, nom_service: "Analyse d'urine", description: "Analyse complète de votre urine." },
        { id: 3, nom_service: "Dépistage COVID", description: "Test pour dépister la présence du COVID-19." },
        { id: 4, nom_service: "Dépistage IST", description: "Test pour dépister les infections sexuellement transmissibles." }
    ];
}

async function showSpecialty(specialty) {
    const container = document.getElementById('specialists-container');
    container.innerHTML = ''; // Effacer le contenu précédent

    const title = document.createElement('h2');
    title.textContent = `Spécialistes en ${specialty}`;
    container.appendChild(title);

    const doctors = (await fetchDoctors()).filter(doctor => doctor.Specialite === specialty);

    if (doctors.length > 0) {
        doctors.forEach(doctor => {
            const doctorDiv = document.createElement('div');
            doctorDiv.classList.add('doctor');

            const img = document.createElement('img');
            img.src = `images/${doctor.Photo}`;
            img.alt = `${doctor.Prenom} ${doctor.Nom}`;
            doctorDiv.appendChild(img);

            const infoDiv = document.createElement('div');
            infoDiv.classList.add('doctor-info');

            const name = document.createElement('h3');
            name.textContent = `Dr. ${doctor.Prenom} ${doctor.Nom}`;
            infoDiv.appendChild(name);

            doctorDiv.appendChild(infoDiv);

            const actionsDiv = document.createElement('div');
            actionsDiv.classList.add('actions');

            const viewCvButton = document.createElement('a');
            viewCvButton.href = `#cv-container-${doctor.ID_Medecin}`;
            viewCvButton.textContent = "Voir CV";
            viewCvButton.onclick = function() {
                document.getElementById(`cv-container-${doctor.ID_Medecin}`).style.display = 'block';
            };
            actionsDiv.appendChild(viewCvButton);

            const appointmentButton = document.createElement('a');
            appointmentButton.href = `appointments.html?doctor=${doctor.Prenom}-${doctor.Nom}`;
            appointmentButton.textContent = "Prendre Rendez-vous";
            actionsDiv.appendChild(appointmentButton);

            const chatButton = document.createElement('a');
            chatButton.href = `chatroom.html?doctor=${doctor.Prenom}-${doctor.Nom}`;
            chatButton.textContent = "Discuter avec le médecin";
            actionsDiv.appendChild(chatButton);

            doctorDiv.appendChild(actionsDiv);
            container.appendChild(doctorDiv);

            const cvContainer = document.createElement('div');
            cvContainer.id = `cv-container-${doctor.ID_Medecin}`;
            cvContainer.classList.add('cv-container');
            cvContainer.style.display = 'none';

            const cvFrame = document.createElement('iframe');
            cvFrame.src = `images/${doctor.CV}`;
            cvFrame.classList.add('cv-frame');

            cvContainer.appendChild(cvFrame);
            container.appendChild(cvContainer);
        });
    } else {
        container.textContent = "Aucun spécialiste trouvé pour cette spécialité.";
    }
}

async function showLaboratoire() {
    const container = document.getElementById('specialists-container');
    container.innerHTML = ''; // Effacer le contenu précédent

    const title = document.createElement('h2');
    title.textContent = "Services de Laboratoire";
    container.appendChild(title);

    const services = await fetchServices();

    if (services.length > 0) {
        services.forEach(service => {
            const serviceDiv = document.createElement('div');
            serviceDiv.classList.add('service');

            const name = document.createElement('h3');
            name.textContent = service.nom_service;
            serviceDiv.appendChild(name);

            const description = document.createElement('p');
            description.textContent = service.description;
            serviceDiv.appendChild(description);

            container.appendChild(serviceDiv);
        });
    } else {
        container.textContent = "Aucun service de laboratoire trouvé.";
    }
}
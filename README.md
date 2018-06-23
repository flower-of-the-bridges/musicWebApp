# Definizione del Problema
Il progetto ha come scopo la creazione di un’applicazione web che offra un servizio a:
- Musicisti indipendenti che vogliono far conoscere la propria musica ed allo stesso tempo di avere un supporto diretto dagli utenti.
- Amanti della musica che vogliono espandere i propri orizzonti musicali verso alternative non convenzionali ai supporti attualmente disponibili (youtube,  spotify, …..).

# Opportunità di Business e Posizionamento del Prodotto
L’applicazione web propone un sistema di finanziamento di tipo “Reward – CrowdFunding (keep-it-all)”, da ascoltatore a musicista.
Vuole influenzare l’attuale comunità musicale proponendo un'alternativa non convenzionale agli attuali canali di distribuzione del media.

# Utenti del Sistema
- Visitatori non registrati
- Ascoltatori
- Musicisti

# Elenco delle funzionalità
Di seguito è presente un elenco delle funzionalità fin'ora implementate, a cui a fianco è presente tra parentesi il nome di chi vi ha contribuito. 

## Gestione Brani (Tutti)
### Utenti coinvolti
Tutte le tipologie di utenti
### Descrizione
Funzionalità che definisce come:
- caricare un brano(upload del file e inserimento di informazioni aggiuntive)
- rimuovere un brano 
- modificare informazioni e impostazioni del brano
- gestire i permessi di visualizzazione di un brano 
- visualizzare un brano 
## Gestione Utenti (Tutti)
### Utenti coinvolti
- Ascoltatore
- Musicista
### Descrizione
Funzionalità che definisce come : 
- registrare un utente
- autenticare un utente
- visualizzare il proprio profilo 

## Gestione Supporto (Marco)
### Utenti coinvolti
Musicista
### Descrizione
Funzionalità che permette ad un musicista di:
- stabilire il periodo e contributo con cui un utente può supportarlo.
- controllare l’elenco degli utenti che lo supportano.

## Gestione Profilo Utente (Davide)
### Utenti coinvolti
- Ascoltatore
- Musicista
- Moderatore
### Descrizione 
Funzionalità che permette di gestire:
- nome e cognome (se non musicista)
- descrizione 
- foto profilo 
- data e luogo di nascita
- genere musicale (se musicista)

## Ricerca (Giovanni)
### Utenti coinvolti:
Tutti
### Descrizione: 
Funzionalità che definisce come trovare brani e artisti attraverso vari parametri di ricerca.

## Supportare Musicista (Marco)
### Utenti coinvolti
- Ascoltatore 
- Musicista
### Descrizione
Funzionalità che permette ad un ascoltatore/musicista di:
- supportare un musicista.
- controllare l’elenco degli utenti supportati ed eventualmente rimuovere delle associazioni.

## Seguire utente (Giovanni)
### Utenti coinvolti
- Ascoltatore 
- Musicista
### Descrizione
Funzionalità che permette all’utente di seguire un ascoltatore/musicista per permettere all’utente di raggiungere subito la sua pagina.

## Segnalare (Davide)
### Utenti coinvolti
- Ascoltatore
- Musicista
### Descrizione
Funzionalità che permette di segnalare utenti e brani ai moderatori.

## Gestione Segnalazione (Davide)
### Utenti coinvolti
Moderatore
### Descrizione
Funzionalità che permette ai moderatori di ricevere segnalazioni e vederne lo stato.

# Implementazione funzionalità
Le funzionalità del precedente paragrafo sono state implementate seguendo uno sviluppo dell'applicazione basato su quattro strati:
- **View** (Marco, Giovanni)
- **Controller** (Tutti)
- **Entity** (Tutti)
- **Foundation** (Tutti)

# Installazione
L'applicazione è stata svilupatta in PHP e provata su XAMPP, una piattaforma software che contiene strumenti quali:
- Server Apache
- Il DBMS MySQL
- PHP (Versione 7.2.1)

Pertanto l'applicazione dovrà richiedere un'installazione di XAMPP, in particolare la cartella contenente l'applicativo dovrà essere posizionata nella cartella _htdocs_ . Raggiungendo l'applicazione attraverso l'URL
``` localhost/deepmusic/ ```
verrà richiesta inizialmente una configurazione per creare e popolare il database. Al primo avvio infatti verrà sottoposta una form, in cui verranno richiesti:
- nome utente del DBMS
- password del DBMS
- nome che si vuole dare al database

Tali file verranno salvati in un file di configurazione, _config.inc.php_, che sarà utilizzato dallo strato Foundation per comunicare con il dbms. Tale procedimento, così come i meccanismi di sessione adoperati dall'applicativo, richiedono l'attivazione nel browser dei cookie.



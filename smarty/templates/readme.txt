In ogni pagina e' stata aggiunta la navbar tramite comando

		{include file="navbar.tpl"}

La pagina principale in cui naviga l'utente e' profile.tpl, che
visualizzera':
 
- le informazioni contenute in userInfo.tpl
- le opzioni per il following / supporto in followOptions.tpl
- il div centrale ospitera' di volta in volta le informazioni dell'utente, come:
	
	- lista canzoni
	- canzone singola
	- ...
Tali informazioni sono contenute nei template associate e la loro inclusione nella pagina principale e' regolata da un costrutto if/else

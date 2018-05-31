<?php
/**
 * 
 * @author gruppo 2
 * 
 * La classe FTarget contiene stringhe da utilizzare come parametro per FPersistantManager 
 * per specificare, in funzionalita come load o exists, i tipi di query che si vogliono
 * utilizzare per una data classe. In particolare:
 * EUser supporta:
 * 
 *  - EXISTS_NICKNAME
 *  - EXISTS_MAIL
 *  - EXISTS_USER
 *  
 * ESong supporta:
 * 
 *  - EXISTS_SONG
 *  - LOAD_MUSICIAN_SONG
 * 
 * EFollower supporta necessariamente:
 * 
 *  - LOAD_FOLLOWERS
 *  - LOAD_FOLLOWING
 *  - EXISTS_FOLLOWER
 *  
 * ESupporter supporta necessariamente:
 * 
 *  - LOAD_SUPPORTERS
 *  - LOAD_SUPPORTING
 *  - EXISTS_SUPPORTER
 * 
 */
class FTarget
{
    const LOAD_MUSICIAN_SONG = 'MusicianSongs'; /** caricamento delle canzoni di un musicista */
    const LOAD_FOLLOWERS = 'Followers'; /** caricamento dei follower di un utente */
    const LOAD_FOLLOWING = 'Following'; /** caricamento dei following di un utente */
    const LOAD_MOD_REPORTS = 'ModReports'; /** caricamento dei report di un moderatore */
    const LOAD_SUPPORTERS = 'Supporters'; /** caricamento dei supporters */
    const LOAD_SUPPORTING = 'Supporting'; /** caricamento dei musicisti supportati */
    const EXISTS_NICKNAME = 'NickName'; /** verifica che un nickname non sia utilizzato */
    const EXISTS_MAIL = 'Mail'; /** verifica che una mail non sia utilizzata */
    const EXISTS_USER = 'User'; /** verifica che un utente sia autenticato correttamente */
    const EXISTS_SUPPORTER = 'Supporter'; /** verifica che un utente sta supportando un musicista */
    const EXISTS_FOLLOWER = 'Follower'; /** verifica che un utente sta seguendo un altro utente */
}


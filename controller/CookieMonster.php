<?php
/**
 *    Cookie Monster Class
 * Handles setting, detection and desctruction of cookies
 *
 * nom nom nom
 *            \   _  _
 *              _/0\/ \_
 *     .-.   .-` \_/\0/ '-.
 *    /:::\ / ,_________,  \
 *   /\:::/ \  '. (:::/  `'-;
 *   \ `-'`\ '._ `"'"'\__    \
 *    `'-.  \   `)-=-=(  `,   |
 *        \  `-"`      `"-`   /
 *
 * @version 01
 * @author Stephen McMahon <stephentmcm@gmail.com>
 */
class CookieMonster
{
    private $database;
    private $user;

    public function __construct()
    {
    }

    public function setDatabase(PDO $database)
    {
        $this->database = $database;
        $this->user = new User($this->database);
    }

    public function lookForCookies()
    {
        //Found Any cookies?
        if (!empty($_COOKIE['cookie'])) {

            $cookie = $_COOKIE['cookie'];

            if ($this->eatCookie($cookie)) {

                //User model tries to log in and will return the result
                return($this->user->automaticLogin($cookie['username']));

            }
        }
    }

    private function eatCookie($cookie)
    {
        $lastLogin = $this->user->getlastLogin($cookie['username']);

        $hash = $this->bakeCookie($cookie['username'].$lastLogin);

        if ($hash === $cookie['hash']) {
            return true;
        } else {
            return false;
        }

    }

    public function giveCookie(User $user)
    {
        $hash = $this->bakeCookie($user->getUsername(),$user->getLastLogin());

        $oneMonthFromNow = time() + (30 * 7 * 24 * 60 * 60);

        // set the cookies
        setcookie("cookie[username]", $user->getUsername(), $oneMonthFromNow);

        setcookie("cookie[hash]", $hash, $oneMonthFromNow);

    }

    public function bakeCookie($username, $lastLogin)
    {
        return(crypt($username.$lastLogin));
    }

    public function smashCookies(User $user)
    {
        //Set time to past to expire the cookie
        $pastTime = time() - 500;

        // set the cookies
        setcookie("cookie[username]", $user->getUsername(), $pastTime);

        setcookie("cookie[hash]", null, $pastTime);

    }
}

<?php
namespace Jetiradoro\SessionManager\Test;

/**
 * Created by PhpStorm.
 * User: Chusky
 * Date: 7/12/18
 * Time: 10:33
 */

class SessionsTest extends BaseTest
{
    /** @test */
    public function get_current_sessions(){
        $user1 = new User();
        $this->actingAs($user1);

        $this->get(config('current-connections.route_get_sessions'))->assertSuccessful();
    }
}

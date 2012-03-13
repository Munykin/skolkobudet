<ul id="uactions">
    <li id="uname"><span class="ua1"></span><?=$this->session->userdata( 'username' )?></li>
    <li><a href="<?=base_url()?>objects/"><span class="ua2"></span>Мои объекты</a></li>
    <li><a href="<?=base_url()?>settings/"><span class="ua3"></span>Настройки</a></li>
    <li><a href="<?=base_url()?>logout/"><span class="ua4"></span>Выход</a></li>                
</ul>
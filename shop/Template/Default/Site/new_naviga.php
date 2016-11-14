<div class="nav_box">
    <div class="w">
        <div class="nav_logo fl">
            <a href="/">
                <content action="lists" catid="3" num="1" order="listorder DESC, id DESC">
                   <volist name="data" id="vo">
                       <img class="dblock" src="{$vo.thumb}" />
                   </volist>
                </content>
            </a></div>
        <php>$parent_id = getCategory($catid,'parentid');</php>
        <div class="nav fr">
            <ul class="clearfix" id="Menus">
                <li <if condition="$catid eq ''">class="thisli"</if>>
                    <a href="/" class="firsrNav-name NavH">{:getCategory(3,'catname')}</a>
                </li>
                <li <if condition="($catid eq 4) OR ($parent_id eq 4)">class="thisli"</if>>
                    <a href="{:getCategory(4,'menuurl')}" class="firsrNav-name NavA"><span class="Arrow"></span>{:getCategory(4,'catname')}</a>
                    <div class="submenu fwly" style="left: -230px; display: none;">
                        <ul>
                            <content action="category" catid="4" order="listorder asc">
                                <volist name="data" id="vo">
                                    <li><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
                                </volist>
                            </content>
                        </ul>
                        <content action="lists" catid="13" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{:U('Content/Index/lists',array('catid' => 13))}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{:U('Content/Index/lists',array('catid' => 13))}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                        <content action="lists" catid="14" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{:U('Content/Index/lists',array('catid' => 14))}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{:U('Content/Index/lists',array('catid' => 14))}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>

                    </div>
                </li>
                <li <if condition="($catid eq 5) OR ($parent_id eq 5)">class="thisli"</if>>
                    <a href="{:getCategory(5,'menuurl')}" class="firsrNav-name NavN"><span class="Arrow"></span>{:getCategory(5,'catname')}</a>
                    <div class="submenu fwly" style="left: -330px; display: none;">
                        <ul>
                            <content action="category" catid="5" order="listorder asc">
                                <volist name="data" id="vo">
                                    <li><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
                                </volist>
                            </content>
                        </ul>
                        <content action="lists" catid="19" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{$vo.url}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{$vo.url}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                        <content action="lists" catid="20" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{$vo.url}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{$vo.url}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                    </div>
                </li>
                <li <if condition="($catid eq 6) OR ($parent_id eq 6)">class="thisli"</if>>
                    <a href="{:getCategory(6,'menuurl')}" class="firsrNav-name NavP"><span class="Arrow"></span>{:getCategory(6,'catname')}</a>
                    <div class="submenu fwly" style="left: -430px; display: none;">
                        <ul>
                            <content action="category" catid="6" order="listorder asc">
                                <volist name="data" id="vo">
                                    <li><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
                                </volist>
                            </content>
                        </ul>
                        <content action="lists" catid="25" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{$vo.url}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{$vo.url}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                        <content action="lists" catid="26" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{$vo.url}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{$vo.url}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                    </div>
                </li>
                <li <if condition="($catid eq 7) OR ($parent_id eq 7)">class="thisli"</if>>
                    <a href="{:getCategory(7,'menuurl')}" class="firsrNav-name NavM"><span class="Arrow"></span>{:getCategory(7,'catname')}</a>
                    <div class="submenu fwly" style="left: -430px; display: none;">
                        <ul>
                            <content action="category" catid="7" order="listorder asc">
                                <volist name="data" id="vo">
                                    <li><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
                                </volist>
                            </content>
                        </ul>
                        <content action="lists" catid="32" num="2" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{:U('Content/Index/lists',array('catid' => 32))}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{:U('Content/Index/lists',array('catid' => 32))}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                    </div>
                </li>
                <li <if condition="($catid eq 8) OR ($parent_id eq 8)">class="thisli"</if>>
                    <a href="{:getCategory(8,'menuurl')}" class="firsrNav-name NavR"><span class="Arrow"></span>{:getCategory(8,'catname')}</a>
                    <div class="submenu fwly" style="left: -430px; display: none;">
                        <ul>
                            <content action="category" catid="8" order="listorder asc">
                                <volist name="data" id="vo">
                                    <li><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
                                </volist>
                            </content>
                        </ul>
                        <content action="lists" catid="34" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{$vo.url}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{$vo.url}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                        <content action="lists" catid="35" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{$vo.url}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{$vo.url}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                    </div>
                </li>
                <li <if condition="($catid eq 9) OR ($parent_id eq 9)">class="thisli"</if>>
                    <a href="{:getCategory(9,'menuurl')}" class="firsrNav-name NavA"><span class="Arrow"></span>{:getCategory(9,'catname')}</a>
                    <div class="submenu fwly" style="left: -430px; display: none;">
                        <ul>
                            <content action="category" catid="9" order="listorder asc">
                                <volist name="data" id="vo">
                                    <li><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
                                </volist>
                            </content>
                        </ul>
                        <content action="lists" catid="38" num="2" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{:U('Content/Index/lists',array('catid' => 38))}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{:U('Content/Index/lists',array('catid' => 38))}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                    </div>
                </li>
                <li <if condition="($catid eq 10) OR ($parent_id eq 10)">class="thisli"</if>>
                    <a href="{:getCategory(10,'menuurl')}" class="firsrNav-name NavR"><span class="Arrow"></span>{:getCategory(10,'catname')}</a>
                    <div class="submenu fwly" style="left: -530px; display: none;">
                        <ul>
                            <content action="category" catid="10" order="listorder asc">
                                <volist name="data" id="vo">
                                    <li><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
                                </volist>
                            </content>
                        </ul>
                        <content action="lists" catid="40" num="2" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{:U('Content/Index/lists',array('catid' => 40))}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{:U('Content/Index/lists',array('catid' => 40))}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                    </div>
                </li>
                <li <if condition="($catid eq 11) OR ($parent_id eq 11)">class="thisli"</if>>
                    <a href="{:getCategory(11,'menuurl')}" class="firsrNav-name NavC"><span class="Arrow"></span>{:getCategory(11,'catname')}</a>
                    <div class="submenu fwly" style="left: -630px; display: none;">
                        <ul>
                            <content action="category" catid="11" order="listorder asc">
                                <volist name="data" id="vo">
                                    <li><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
                                </volist>
                            </content>
                        </ul>
                        <content action="lists" catid="42" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{:U('Content/Index/lists',array('catid' => 42))}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{:U('Content/Index/lists',array('catid' => 42))}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                        <content action="lists" catid="43" num="1" order="listorder asc, id desc">
                            <volist name="data" id="vo">
                                <if condition="$data neq ''">
                                    <div class="fwly_box">
                                        <a href="{$vo.url}"><img src="{$vo.thumb}" /></a>
                                        <h3><a href="{$vo.url}">{$vo.title}</a></h3>
                                        <p>{$vo.description}</p>
                                    </div>
                                </if>
                            </volist>
                        </content>
                    </div>
                </li>
            </ul>
            <div class="clear clearfix"></div>
        </div>
        <div class="clear clearfix"></div>
    </div>
</div>
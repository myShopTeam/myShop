<div class="fl nb_cent_l">
    <div class="nei_title">
        <php>$parentid = getCategory($catid,'parentid');</php>
        <p>{:getCategory($parentid, 'catname')}</p>
        <p class="eng">{:getCategory($parentid, 'catdir')}</p>
    </div>
    <div class="n_menu" id="n_menu">
        <ul>
            <content action="category" catid="$parentid" num="99" order="listorder ASC">
               <volist name="data" id="vo" key="k">
                   <li <if condition="$vo['catid'] eq $catid">class="thisli"</if>><a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}</a></li>
               </volist>
            </content>
        </ul>
    </div>
    <div class="LeftContact">
        <div class="ctImg"><img src="{$site_info.enterprise_path}images/left_contact.jpg" /></div>
        <div class="leftBtn">
            <h3 class="Title">{:getCategory(8, 'catname')}</h3>
            <p>
                <content action="category" catid="8" num="3" order="listorder ASC">
                    <volist name="data" id="vo" key="k">
                        <a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>"><img src="{$vo.image}" /></a>
                    </volist>
                </content>
            </p>
        </div>
    </div>
</div>
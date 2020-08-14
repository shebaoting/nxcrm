<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection roles
     * @property Grid\Column|Collection permissions
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection user
     * @property Grid\Column|Collection method
     * @property Grid\Column|Collection path
     * @property Grid\Column|Collection ip
     * @property Grid\Column|Collection input
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection alias
     * @property Grid\Column|Collection authors
     * @property Grid\Column|Collection enable
     * @property Grid\Column|Collection imported
     * @property Grid\Column|Collection config
     * @property Grid\Column|Collection require
     * @property Grid\Column|Collection require_dev
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection url
     * @property Grid\Column|Collection address
     * @property Grid\Column|Collection admin_users_id
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection wechat
     * @property Grid\Column|Collection position
     * @property Grid\Column|Collection gender
     * @property Grid\Column|Collection customer_id
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection contact_id
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection signdate
     * @property Grid\Column|Collection expiretime
     * @property Grid\Column|Collection total
     * @property Grid\Column|Collection receive
     * @property Grid\Column|Collection paymethod
     * @property Grid\Column|Collection billtype
     * @property Grid\Column|Collection contract_id
     * @property Grid\Column|Collection remark
     * @property Grid\Column|Collection files
     * @property Grid\Column|Collection electronic
     * @property Grid\Column|Collection state
     * @property Grid\Column|Collection subject
     * @property Grid\Column|Collection expectincome
     * @property Grid\Column|Collection expectendtime
     * @property Grid\Column|Collection dealchance
     * @property Grid\Column|Collection tempo
     * @property Grid\Column|Collection ename
     * @property Grid\Column|Collection cname
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection opportunity_id
     * @property Grid\Column|Collection salesexpenses
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection email_verified_at
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection roles(string $label = null)
     * @method Grid\Column|Collection permissions(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection user(string $label = null)
     * @method Grid\Column|Collection method(string $label = null)
     * @method Grid\Column|Collection path(string $label = null)
     * @method Grid\Column|Collection ip(string $label = null)
     * @method Grid\Column|Collection input(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection alias(string $label = null)
     * @method Grid\Column|Collection authors(string $label = null)
     * @method Grid\Column|Collection enable(string $label = null)
     * @method Grid\Column|Collection imported(string $label = null)
     * @method Grid\Column|Collection config(string $label = null)
     * @method Grid\Column|Collection require(string $label = null)
     * @method Grid\Column|Collection require_dev(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection url(string $label = null)
     * @method Grid\Column|Collection address(string $label = null)
     * @method Grid\Column|Collection admin_users_id(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection wechat(string $label = null)
     * @method Grid\Column|Collection position(string $label = null)
     * @method Grid\Column|Collection gender(string $label = null)
     * @method Grid\Column|Collection customer_id(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection contact_id(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection signdate(string $label = null)
     * @method Grid\Column|Collection expiretime(string $label = null)
     * @method Grid\Column|Collection total(string $label = null)
     * @method Grid\Column|Collection receive(string $label = null)
     * @method Grid\Column|Collection paymethod(string $label = null)
     * @method Grid\Column|Collection billtype(string $label = null)
     * @method Grid\Column|Collection contract_id(string $label = null)
     * @method Grid\Column|Collection remark(string $label = null)
     * @method Grid\Column|Collection files(string $label = null)
     * @method Grid\Column|Collection electronic(string $label = null)
     * @method Grid\Column|Collection state(string $label = null)
     * @method Grid\Column|Collection subject(string $label = null)
     * @method Grid\Column|Collection expectincome(string $label = null)
     * @method Grid\Column|Collection expectendtime(string $label = null)
     * @method Grid\Column|Collection dealchance(string $label = null)
     * @method Grid\Column|Collection tempo(string $label = null)
     * @method Grid\Column|Collection ename(string $label = null)
     * @method Grid\Column|Collection cname(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection opportunity_id(string $label = null)
     * @method Grid\Column|Collection salesexpenses(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection username
     * @property Show\Field|Collection name
     * @property Show\Field|Collection roles
     * @property Show\Field|Collection permissions
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection user
     * @property Show\Field|Collection method
     * @property Show\Field|Collection path
     * @property Show\Field|Collection ip
     * @property Show\Field|Collection input
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection version
     * @property Show\Field|Collection alias
     * @property Show\Field|Collection authors
     * @property Show\Field|Collection enable
     * @property Show\Field|Collection imported
     * @property Show\Field|Collection config
     * @property Show\Field|Collection require
     * @property Show\Field|Collection require_dev
     * @property Show\Field|Collection email
     * @property Show\Field|Collection url
     * @property Show\Field|Collection address
     * @property Show\Field|Collection admin_users_id
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection wechat
     * @property Show\Field|Collection position
     * @property Show\Field|Collection gender
     * @property Show\Field|Collection customer_id
     * @property Show\Field|Collection content
     * @property Show\Field|Collection contact_id
     * @property Show\Field|Collection status
     * @property Show\Field|Collection signdate
     * @property Show\Field|Collection expiretime
     * @property Show\Field|Collection total
     * @property Show\Field|Collection receive
     * @property Show\Field|Collection paymethod
     * @property Show\Field|Collection billtype
     * @property Show\Field|Collection contract_id
     * @property Show\Field|Collection remark
     * @property Show\Field|Collection files
     * @property Show\Field|Collection electronic
     * @property Show\Field|Collection state
     * @property Show\Field|Collection subject
     * @property Show\Field|Collection expectincome
     * @property Show\Field|Collection expectendtime
     * @property Show\Field|Collection dealchance
     * @property Show\Field|Collection tempo
     * @property Show\Field|Collection ename
     * @property Show\Field|Collection cname
     * @property Show\Field|Collection value
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection opportunity_id
     * @property Show\Field|Collection salesexpenses
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection email_verified_at
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection roles(string $label = null)
     * @method Show\Field|Collection permissions(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection user(string $label = null)
     * @method Show\Field|Collection method(string $label = null)
     * @method Show\Field|Collection path(string $label = null)
     * @method Show\Field|Collection ip(string $label = null)
     * @method Show\Field|Collection input(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection alias(string $label = null)
     * @method Show\Field|Collection authors(string $label = null)
     * @method Show\Field|Collection enable(string $label = null)
     * @method Show\Field|Collection imported(string $label = null)
     * @method Show\Field|Collection config(string $label = null)
     * @method Show\Field|Collection require(string $label = null)
     * @method Show\Field|Collection require_dev(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection url(string $label = null)
     * @method Show\Field|Collection address(string $label = null)
     * @method Show\Field|Collection admin_users_id(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection wechat(string $label = null)
     * @method Show\Field|Collection position(string $label = null)
     * @method Show\Field|Collection gender(string $label = null)
     * @method Show\Field|Collection customer_id(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection contact_id(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection signdate(string $label = null)
     * @method Show\Field|Collection expiretime(string $label = null)
     * @method Show\Field|Collection total(string $label = null)
     * @method Show\Field|Collection receive(string $label = null)
     * @method Show\Field|Collection paymethod(string $label = null)
     * @method Show\Field|Collection billtype(string $label = null)
     * @method Show\Field|Collection contract_id(string $label = null)
     * @method Show\Field|Collection remark(string $label = null)
     * @method Show\Field|Collection files(string $label = null)
     * @method Show\Field|Collection electronic(string $label = null)
     * @method Show\Field|Collection state(string $label = null)
     * @method Show\Field|Collection subject(string $label = null)
     * @method Show\Field|Collection expectincome(string $label = null)
     * @method Show\Field|Collection expectendtime(string $label = null)
     * @method Show\Field|Collection dealchance(string $label = null)
     * @method Show\Field|Collection tempo(string $label = null)
     * @method Show\Field|Collection ename(string $label = null)
     * @method Show\Field|Collection cname(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection opportunity_id(string $label = null)
     * @method Show\Field|Collection salesexpenses(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     */
    class Show {}

    /**
     * @method \Dcat\Admin\Form\Field\Button button(...$params)
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}

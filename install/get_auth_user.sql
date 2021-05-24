use db_xblog;

-- 创建存储过程，用来获取用户权限列表
drop procedure if exists  get_auth_user;
DELIMITER //
create procedure get_auth_user(p_username varchar(128))
begin
	drop table if exists tb_tmp_auth_nonzero;
	create temporary table tb_tmp_auth_nonzero (
		select distinct id_authority, mask from (
				select 
					id_authority, 
					case when (mask != 1) 
					then 1 
					else mask
					end mask 
				from tb_auth_group where id_group in(
					select id from tb_group where id in(
						select id_group from tb_user_group where id_user in (
							select id from tb_user where name = p_username
						)
					) and mask <> 0
				)
				union all
				select id_authority, 1 mask from tb_auth_user where id_user in (
					select id from tb_user where name = p_username
				)
		) a
	);

	set @ret = 0;
	select count(*) into @ret from tb_group where id in(
		select id_group from tb_user_group where id_user in (
			(select id from tb_user where name = p_username)
		)
	) and mask = 0;
	drop table if exists tb_tmp_auth_zero;
	create temporary table tb_tmp_auth_zero (
		select id id_authority, 0 mask from tb_authority where @ret <> 0
	);

	drop table if exists tb_tmp_ret;
    create temporary table tb_tmp_ret (
		select id_authority from (
			select 
				nz.id_authority, 
				nz.mask * (case when (isnull(z.mask)) then 1 else z.mask end) mask 
			from
				(select * from tb_tmp_auth_nonzero) nz
				left join
				(select * from tb_tmp_auth_zero) z
				on nz.id_authority = z.id_authority
		) a where mask != 0
    );
    
    drop table if exists tb_tmp_auth_zero;
    drop table if exists tb_tmp_auth_nonzero;
end //
DELIMITER ;




        
        
        
        
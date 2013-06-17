
/** admin indexes **/
db.getCollection("admin").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** content_pages indexes **/
db.getCollection("content_pages").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** global_settings indexes **/
db.getCollection("global_settings").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** members indexes **/
db.getCollection("members").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** memberships indexes **/
db.getCollection("memberships").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** store indexes **/
db.getCollection("store").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** system.users indexes **/
db.getCollection("system.users").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** system.users indexes **/
db.getCollection("system.users").ensureIndex({
  "user": NumberInt(1),
  "userSource": NumberInt(1)
},{
  "unique": true
});

/** admin records **/
db.getCollection("admin").insert({
  "_id": ObjectId("51aef39b7be5dad00e000000"),
  "email": "mobeen@pwoxisolutions.com",
  "name": "mobeen",
  "password": "21232f297a57a5a743894a0e4a801fc3",
  "username": "admin"
});

/** content_pages records **/
db.getCollection("content_pages").insert({
  "_id": ObjectId("51b9d4597be5dac814000002"),
  "page_title": "Contact Us",
  "page_name": "contact_us",
  "last_modified": NumberInt(1371133017),
  "created_date": "1371132995",
  "content": "<p>comming soon<\/p>",
  "status": "active",
  "url": "contact_us"
});
db.getCollection("content_pages").insert({
  "_id": ObjectId("51b9da727be5dac814000004"),
  "content": "<ul>\r\n<li>Admin log in form<\/li>\r\n<li>Admin Dashboard Page.<\/li>\r\n<li>Admin Log out<\/li>\r\n<li>Members Management (Admin can view all the registered members.Can delete members.Search members by first name and last name).<\/li>\r\n<li>Memberships Management (Admin can view all the memberships taken by members.Their details like amount,name,currency etc. Can delete memberships. Search members in memberships by first name and last name. Can search memberships by starting and ending date).<\/li>\r\n<li>Admin Profile &#40;Admin Settings\/Manage Content&#41;<\/li>\r\n<li>Admin Settings (Admin can change his username\/password).<\/li>\r\n<li>Manage Content (Content can be created\/updated)<\/li>\r\n<\/ul>",
  "created_date": "1371134549",
  "last_modified": NumberInt(1371188264),
  "page_name": "disclaimer",
  "page_title": "Disclaimer",
  "status": "inactive",
  "url": "disclaimer"
});
db.getCollection("content_pages").insert({
  "_id": ObjectId("51b5c73c7be5da2412000001"),
  "content": "<div>\r\n<div><span>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.<\/span><\/div>\r\n<\/div>",
  "created_date": NumberInt(1370850819),
  "last_modified": NumberInt(1371188916),
  "page_name": "about us",
  "page_title": "About Us",
  "parent_id": "0",
  "slug": "about_us",
  "status": "active",
  "url": "about_us"
});

/** global_settings records **/
db.getCollection("global_settings").insert({
  "_id": ObjectId("51bafe707be5da1010000001"),
  "review_cut": "8.5"
});

/** members records **/
db.getCollection("members").insert({
  "_id": ObjectId("51baf50d7be5da2011000000"),
  "first_name": "Mubeen",
  "last_name": "Ahmed",
  "twitter_id": NumberInt(380472104),
  "created_date": NumberInt(1371206925),
  "deleted_status": NumberInt(0),
  "avatar": "",
  "username": "mobeen4chand",
  "membership_type": "",
  "status": "active",
  "email": "",
  "password": "",
  "twitter_account": "yes",
  "facebook_account": "no"
});
db.getCollection("members").insert({
  "_id": ObjectId("51bb01b57be5da2011000001"),
  "email": "mobeen@pwoxisolutions.com",
  "password": "72cede3474257595e7b557b154b7a132",
  "username": "mobeen",
  "created_date": NumberInt(1371210165),
  "first_name": "mobeen",
  "last_name": "ahmed",
  "membership_type": "free",
  "status": "inactive",
  "deleted_status": NumberInt(0),
  "avatar": null,
  "twitter_id": "",
  "twitter_account": "",
  "facebook_account": "",
  "facebook_id": ""
});
db.getCollection("members").insert({
  "_id": ObjectId("51bb0ded7be5da6010000005"),
  "email": "mobeen@pwxcsxcxcxoxisolutions.com",
  "password": "47faff86ec6b8cc303f8276c900b137b",
  "username": "mobeen",
  "created_date": NumberInt(1371213293),
  "first_name": "svdsvd",
  "last_name": "cvdvcsd",
  "membership_type": "free",
  "status": "inactive",
  "deleted_status": NumberInt(0),
  "avatar": null,
  "twitter_id": "",
  "twitter_account": "",
  "facebook_account": "",
  "facebook_id": ""
});

/** memberships records **/
db.getCollection("memberships").insert({
  "_id": ObjectId("51b855dc7be5daac03000000"),
  "amount": NumberInt(7000),
  "currency": "usd",
  "customer_id": "cus_20CQTgDoo0zTLx",
  "customer_id_by_stripe": "cus_20CQTgDoo0zTLx",
  "deleted_status": NumberInt(0),
  "first_name": "mobeen",
  "last_name": "ahmed",
  "memberid": ObjectId("519e0e7a7be5da3814000004"),
  "membership_ending_time": NumberInt(1373627100),
  "membership_type": "gold",
  "paid_status": true,
  "payment_time": NumberInt(1371035100),
  "receipt_id": "ch_20CQrRGlgbkvtM",
  "stripe_fee": NumberInt(233),
  "stripe_fee_currency": "usd"
});
db.getCollection("memberships").insert({
  "_id": ObjectId("51b857347be5da680e000001"),
  "amount": NumberInt(3500),
  "currency": "usd",
  "customer_id": "cus_20CVYp73pEYo5b",
  "customer_id_by_stripe": "cus_20CVYp73pEYo5b",
  "deleted_status": NumberInt(0),
  "first_name": "ateeq",
  "last_name": "ahmed",
  "memberid": ObjectId("51b856d07be5da100f000000"),
  "membership_ending_time": NumberInt(1373627444),
  "membership_type": "silver",
  "paid_status": true,
  "payment_time": NumberInt(1370286000),
  "receipt_id": "ch_20CV4pBS0xqzTC",
  "stripe_fee": NumberInt(132),
  "stripe_fee_currency": "usd"
});
db.getCollection("memberships").insert({
  "_id": ObjectId("51b8579c7be5dae80f000003"),
  "amount": NumberInt(3500),
  "currency": "usd",
  "customer_id": "cus_20CXktwozBtLtK",
  "customer_id_by_stripe": "cus_20CXktwozBtLtK",
  "deleted_status": NumberInt(0),
  "first_name": "junaid",
  "last_name": "ali",
  "memberid": ObjectId("51b8576b7be5daac0e000000"),
  "membership_ending_time": NumberInt(1373627548),
  "membership_type": "silver",
  "paid_status": true,
  "payment_time": NumberInt(1371035548),
  "receipt_id": "ch_20CXez5HfhL3Yf",
  "stripe_fee": NumberInt(132),
  "stripe_fee_currency": "usd"
});
db.getCollection("memberships").insert({
  "_id": ObjectId("51b858037be5da0c0e000001"),
  "amount": NumberInt(7000),
  "currency": "usd",
  "customer_id": "cus_20CZZWjIgRnERm",
  "customer_id_by_stripe": "cus_20CZZWjIgRnERm",
  "deleted_status": NumberInt(0),
  "first_name": "shahid",
  "last_name": "khan",
  "memberid": ObjectId("51b857b97be5dae80f000004"),
  "membership_ending_time": NumberInt(1373627651),
  "membership_type": "gold",
  "paid_status": true,
  "payment_time": NumberInt(1370631600),
  "receipt_id": "ch_20CZ0iSVqNQ3uc",
  "stripe_fee": NumberInt(233),
  "stripe_fee_currency": "usd"
});

/** store records **/
db.getCollection("store").insert({
  "_id": ObjectId("51a349a67be5dacc0c000000"),
  "store_name": "test",
  "store_details": "this is for testing",
  "created_date": NumberInt(1369655718),
  "store_zip": "25140",
  "store_logo": "8415556.jpg",
  "member_id": ObjectId("519e0e7a7be5da3814000004")
});
db.getCollection("store").insert({
  "_id": ObjectId("51b836317be5dae80f000002"),
  "store_name": "test",
  "store_details": "this is for testing",
  "created_date": NumberInt(1371026992),
  "store_zip": "25140",
  "store_logo": null,
  "member_id": ObjectId("51b57a257be5da8011000000")
});
db.getCollection("store").insert({
  "_id": ObjectId("51bb08327be5da6010000004"),
  "store_name": "test",
  "store_details": "this is for testing",
  "created_date": NumberInt(1371211826),
  "store_zip": "25140",
  "store_logo": "social_login_button_06.jpg",
  "member_id": ObjectId("51bb01b57be5da2011000001")
});

/** system.indexes records **/
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "ns": "500px.system.users",
  "name": "_id_"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "user": NumberInt(1),
    "userSource": NumberInt(1)
  },
  "unique": true,
  "ns": "500px.system.users",
  "name": "user_1_userSource_1"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "ns": "500px.bins",
  "name": "_id_"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "ns": "500px.members",
  "name": "_id_"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "ns": "500px.store",
  "name": "_id_"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "ns": "500px.content_pages",
  "name": "_id_"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "ns": "500px.memberships",
  "name": "_id_"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "ns": "500px.admin",
  "name": "_id_"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "ns": "500px.global_settings",
  "name": "_id_"
});

/** system.users records **/
db.getCollection("system.users").insert({
  "_id": ObjectId("519a24c1b3570c2c53a6ad9f"),
  "user": "admin",
  "readOnly": false,
  "pwd": "7c67ef13bbd4cae106d959320af3f704"
});

$(function() {
	window.Resource = {
		instance : {},
		create : function(option) {
			return new Builder(option)
		},
		setText : function(text) {
			if (text != null) {
				$textarea.val(text);
				$contentDiv.html(Emotion.replaceEmoji(text))
			}
		},
		renderArticle : function(data) {
			if (data.length == 0) {
				return
			}
			var $wrapper = $(
					"#"
							+ (data.length == 1 ? "article_reply"
									: "mul_article_reply")
							+ " .msg-item-wrapper").attr("data-id", data[0].id);
			$wrapper.find(".i-title").attr("href",
					"/wxcore/details.php?id=" + data[0].id).text(data[0].title);
			$wrapper.find(".msg-date").text(data[0].create_time);
			$wrapper.find(".i-img").attr("src", data[0].cover_url);
			$wrapper.find(".msg-text").text(data[0].summary);
			if (data.length > 1) {
				$wrapper.find(".sub-msg-item").remove();
				var $list = $wrapper.find(".multi-msg");
				for ( var i = 1; i < data.length; i++) {
					var item = data[i];
					var submsg = "";
					submsg += '<div class="rel sub-msg-item appmsgItem">';
					submsg += '<span class="thumb">';
					submsg += '<img src="' + item.cover_url
							+ '" class="i-img" />';
					submsg += "</span>";
					submsg += '<h4 class="msg-t"><a href="/wxcore/details.php?id='+item.id+'" target="_blank" class="i-title">'
							+ item.title + "</a></h4>";
					submsg += "</div>";
					$list.append(submsg)
				}
				$("#article_reply").hide();
				$("#mul_article_reply").show();
				$cur_article = $("#mul_article_reply")
			} else {
				$("#article_reply").show();
				$cur_article = $("#article_reply");
				$("#mul_article_reply").hide()
			}
		},
		initUploader : function(uid) {
			$("#file_upload1").omFileUpload(
					{
						action : "/uploadsiteimage",
						fileExt : "*.jpg;*.png;*.gif;*.jpeg;*.bmp",
						fileDesc : "Image Files",
						sizeLimit : 100 * 1024,
						onError : function(ID, fileObj, errorObj, event) {
							if (errorObj.type == "File Size") {
								alert("上传图片的大小不能超过100KB")
							}
						},
						autoUpload : true,
						swf : "../../swf/om-fileupload.swf",
						method : "GET",
						actionData : {
							uid : uid
						},
						onComplete : function(ID, fileObj, response, data,
								event) {
							var jsonData = eval("(" + response + ")");
							var $cont = $(this).closest(".cover-area");
							$(".img-area", $cont).show().find(" #img").attr(
									"src", jsonData.fileUrl);
							$("#cover", $cont).val(
									jsonData.fileName
											.substring(jsonData.fileName
													.indexOf("/") + 1))
						}
					});
			$("#r_link .cover-del").click(function() {
				var $cont = $(this).closest(".cover-area");
				$(".img-area", $cont).hide();
				$("#cover", $cont).val("")
			})
		}
	};
	function Builder(opt) {
		this.option = {
			id : "res_block"
		};
		$.extend(this.option, opt);
		this.init();
		return this
	}
	Builder.prototype.init = function() {
		var self = this;
		var opt = this.option;
		var $target = $("#" + opt.id);
		$target.find("#type").change(function() {
			$target.find(".r-module").hide();
			$("#r_" + $(this).val()).show();
			self._changeModule($(this).val())
		});
		this.loadModule = {};
		$target.find(".selArticle").click(
				function() {
					parent.parent.parent.showArticleChoice(self.allowMulArticle ? "all": null);
					return false
				});
		$target.find("#act").change(function() {
			self._loadAct()
		});
		$("#r_activity")
				.delegate(
						"tr.data-row",
						"click",
						function() {
							$(this).closest("table").find("tr").removeClass(
									"selected");
							$(this).addClass("selected").find(".act-sel").attr(
									"checked", "checked")
						});
		Resource.instance[opt.id] = self
	};
	Builder.prototype.getResult = function() {
		var opt = this.option;
		var $target = $("#" + opt.id);
		var module = $target.find("#type").val();
		var data = null;
		switch (module) {
		case "none":
			if ($("#menukeyword").val() == "") {
				alert("当回复类型为无时，菜单关键字不能为空！");
			} else {
				data = {
						exttype : "none"
				};
			}
			break;
		case "text":
			var v = $("textarea[name='replyText']").val();
			if ($.trim(v) == "") {
				alert("文本内容不可以为空。")
			} else {
				if (v.length > 1000) {
					alert("不超过1000个字符。")
				} else {
					data = {
						type : 1,
						text : v
					}
				}
			}
			break;
		case "webapp":
			data = {v : 1}
			break;
		case "signtel":
			data = {v : 1}
			break;
		case "sourceurl":
			data = {v : 1}
			break;
		case "article":
			if (this.dlgArticleSelect) {
				var type = $("#article_reply").is(":visible") ? 5 : 6;
				var id = type == 5 ? "article_reply" : "mul_article_reply";
				var $wrapper = $("#" + id + " .msg-item-wrapper");
				var rid = $wrapper.attr("data-id");
				if (rid == null) {
					alert("请选择图文内容。")
				} else {
					data = {
						type : type,
						id : rid,
						title : $("#" + id + " .i-title").text(),
						extraData : ""
					}
				}
			} else {
				var selRes = $("#article_select").val();
				if (selRes == "") {
					alert("请至少选择一条图文。")
				} else {
					var articles = this.cache.articles;
					var selArt;
					for ( var i = 0, len = articles.length; i < len; i++) {
						if (articles[i].id == selRes) {
							selArt = articles[i];
							data = {
								type : selArt.type,
								id : selArt.id,
								title : selArt.title,
								extraData : ""
							};
							break
						}
					}
				}
			}
			break;
		case "link":
			var $block = $("#url_block");
			var url = $("input[name='source_url']", $block).val();
			if (url == "") {
				alert("链接地址不可以为空！")
			} else {
				if (!/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i
						.test(url)) {
					alert("请输入正确的链接地址格式！")
				} else {
					data = {
						type : 7,
						url : url
					}
				}
			}
			break;
		case "activity":
			var $selected = $("#r_activity .selected");
			if ($selected.length == 0) {
				alert("请至少选择一个正在进行中的活动。")
			} else {
				var t = $target.find("#act").val();
				var id = $selected.attr("data-id");
				if (t == $selected.attr("data-type")) {
					data = {
						type : t,
						id : id,
						title : $selected.find("td.title").text(),
						exttype : "activity",
						extraData : $selected.find(".keyword").text()
					}
				} else {
					alert("网络异常，请尝试刷新本页面再进行操作！")
				}
			}
			break;
		case "business":
			var $selected = $target.find("#r_business :checked");
			if ($selected.length == 0) {
				alert("请选择一个业务模块。")
			} else {
				data = {
					type : $selected.attr("data-type")
				}
			}
			break
		}
		return data
	};
	Builder.prototype._changeModule = function(module) {
		var loaded = this.loadModule[module];
		if (!loaded) {
			switch (module) {
			case "activity":
				this._loadAct();
				break
			}
		}
		this.loadModule[module] = 1
	};
	Builder.prototype._loadAct = function() {
		var self = this;
		var opt = this.option;
		var $target = $("#" + opt.id);
		var data = Resource.instance[opt.id].result;
		var t = $target.find("#act").val();
		$.post(
						"index.php?g=Weixin&m=Diymenu&a=gresource",
						{
							action : "getAct",
							wuid : data.wuid,
							type : t
						},
						function(result) {
							if (result.success) {
								var data = result.data;
								$("#r_activity tr.data-row").remove();
								if (data.length > 0) {
									$("#r_activity .no-record").hide();
									var cont = [];
									for ( var i = 0; i < data.length; i++) {
										var item = data[i];
										cont.push('<tr data-type="' + item.type
												+ '" data-id="' + item.aid
												+ '" class="data-row">');
										cont
												.push('<td><input type="radio" name="act_sel" class="act-sel"/></td>');
										cont.push('<td class="title">'
												+ item.title + "</td>");
										cont.push('<td class="keyword">'
												+ item.keyword + "</td>");
										cont.push("<td>" + item.startDate + "~"
												+ item.endDate + "</td>");
										cont.push("</tr>")
									}
									$("#r_activity table")
											.append(cont.join(""));
									var tmpid = "tr[data-id=" + extid + "]";
									$(tmpid).find("input[type=radio]").attr(
											"checked", "checked");
								} else {
									$("#r_activity .no-record").show()
								}
							}
						}, "json")
	};
	function formatDate(date) {
		if (date == null) {
			return
		}
		var d = new Date();
		d.setTime(date.time);
		return d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate()
	}
	function truncUrl(url) {
		var match = url.match("(http://.*?)/");
		return url.substring(match[1].length)
	}
	function printResult(result) {
		var str = "";
		for ( var key in result) {
			if (result.hasOwnProperty(key)) {
				str += key + "=" + result[key] + "\n"
			}
		}
		alert(str)
	}
});
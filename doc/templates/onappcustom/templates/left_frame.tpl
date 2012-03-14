{include file="header.tpl" top2=true}
<div style="float: right; width: 100px; text-align: right; color:#009ABF; font-size:13px; margin: 36px 10px 0 0" class="notes" >v 1.0</div>
<div class="package-title">{$package}</div>
<div class="package-details">
			
	<!--<dl class="tree">-->
	<!--<dl class="tree">
	    <div class="left-arrow"></div>
		<dt class="folder-title">Description</dt>
		<dd>
			<a href='{$classtreepage}.html' target='right'>Class trees</a><br />
			<a href='{$elementindex}.html' target='right'>Index of elements</a><br />
			{if $hastodos}
                <a href="{$todolink}" target="right">Todo List</a><br />
            {/if}
		</dd>
	</dl>-->
		{section name=p loop=$info}
					
			{if $info[p].subpackage == ""}
				
				{if $info[p].tutorials}
				    <dl class="tree">
				    <div class="left-arrow"></div>
					<dt class="folder-title">Tutorials/Manuals</dt>
					<dd>
					{if $info[p].tutorials.pkg}
						<dl class="tree">
						<dt class="folder-title">Package-level</dt>
						<dd>
						{section name=ext loop=$info[p].tutorials.pkg}
							{$info[p].tutorials.pkg[ext]}
						{/section}
						</dd>
						</dl>
					{/if}
					
					{if $info[p].tutorials.cls}
						<dl class="tree">
						<dt class="folder-title">Class-level</dt>
						<dd>
						{section name=ext loop=$info[p].tutorials.cls}
							{$info[p].tutorials.cls[ext]}
						{/section}
						</dd>
						</dl>
					{/if}
					
					{if $info[p].tutorials.proc}
						<dl class="tree">
						<dt class="folder-title">Function-level</dt>
						<dd>
						{section name=ext loop=$info[p].tutorials.proc}
							{$info[p].tutorials.proc[ext]}
						{/section}
						</dd>
						</dl>
					{/if}
					</dd>
					</dl>
				{/if}
				{if $info[p].hasinterfaces}
				    <dl class="tree">
				    <div class="left-arrow"></div>
					<dt class="folder-title">Interfaces</dt>
					{section name=class loop=$info[p].classes}
					   {if $info[p].classes[class].is_interface}
						<dd><a href='{$info[p].classes[class].link}' target='right'>{$info[p].classes[class].title}</a></dd>
						{/if}
					{/section}
					</dl>
				{/if}
				{if $info[p].hasclasses}
					<dl class="tree">
					<div class="left-arrow"></div>
					<dt class="folder-title">Classes</dt>
					{section name=class loop=$info[p].classes}
					   {if $info[p].classes[class].is_class}
						<dd><a href='{$info[p].classes[class].link}' target='right'>{$info[p].classes[class].title}</a></dd>
					   {/if}
					{/section}
					</dl>
				{/if}
				{if $info[p].functions}
					<dl class="tree">
					<div class="left-arrow"></div>
					<dt class="folder-title">Functions</dt>
					{section name=f loop=$info[p].functions}
						<dd><a href='{$info[p].functions[f].link}' target='right'>{$info[p].functions[f].title}</a></dd>
					{/section}
					</dl>
				{/if}
				{if $info[p].files}
					<dl class="tree">
					<div class="left-arrow"></div>
					<dt class="folder-title">Files</dt>
					{section name=nonclass loop=$info[p].files}
						<dd><a href='{$info[p].files[nonclass].link}' target='right'>{$info[p].files[nonclass].title}</a></dd>
					{/section}
					</dl>
				{/if}
								
			{else}
			    <dl class="tree">
				{if $info[p].tutorials}			
					<dt class="folder-title">Tutorials/Manuals</dt>
					<dd>
					{if $info[p].tutorials.pkg}
						<dl class="tree">
						<dt class="folder-title">Package-level</dt>
						<dd>
						{section name=ext loop=$info[p].tutorials.pkg}
							{$info[p].tutorials.pkg[ext]}
						{/section}
						</dd>
						</dl>
					{/if}
					
					{if $info[p].tutorials.cls}
						<dl class="tree">
						<dt class="folder-title">Class-level</dt>
						<dd>
						{section name=ext loop=$info[p].tutorials.cls}
							{$info[p].tutorials.cls[ext]}
						{/section}
						</dd>
						</dl>
					{/if}
					
					{if $info[p].tutorials.proc}
						<dl class="tree">
						<dt class="folder-title">Function-level</dt>
						<dd>
						{section name=ext loop=$info[p].tutorials.proc}
							{$info[p].tutorials.proc[ext]}
						{/section}
						</dd>
						</dl>
					{/if}
					</dd>
				{/if}
				
				<dt class="sub-package">{$info[p].subpackage}</dt>
				<dd>
					<dl class="tree">
						{if $info[p].subpackagetutorial}
							<div><a href="{$info.0.subpackagetutorialnoa}" target="right">{$info.0.subpackagetutorialtitle}</a></div>
						{/if}
						{if $info[p].classes}
							<dt class="folder-title">Classes</dt>
							{section name=class loop=$info[p].classes}
								<dd><a href='{$info[p].classes[class].link}' target='right'>{$info[p].classes[class].title}</a></dd>
							{/section}
						{/if}
						{if $info[p].functions}
							<dt class="folder-title">Functions</dt>
							{section name=f loop=$info[p].functions}
								<dd><a href='{$info[p].functions[f].link}' target='right'>{$info[p].functions[f].title}</a></dd>
							{/section}
						{/if}
						{if $info[p].files}
							<dt class="folder-title">Files</dt>
							{section name=nonclass loop=$info[p].files}
								<dd><a href='{$info[p].files[nonclass].link}' target='right'>{$info[p].files[nonclass].title}</a></dd>
							{/section}
						{/if}
					</dl>
				</dd>
				</dl>				
			{/if}
			
		{/section}
	<!--</dl>-->
</div>
<p class="notes"><a href="{$phpdocwebsite}" target="_blank">phpDocumentor v <span class="field">{$phpdocversion}</span></a></p>
</BODY>
</HTML>

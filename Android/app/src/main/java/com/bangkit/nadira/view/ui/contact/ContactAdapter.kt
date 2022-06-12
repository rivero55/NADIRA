package com.bangkit.nadira.view.ui.contact


import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.bangkit.nadira.R
import com.bangkit.nadira.data.local.ContactItemModel
import com.bangkit.nadira.databinding.ItemContactBinding
import com.bangkit.nadira.util.networking.Endpoint

class ContactAdapter() : RecyclerView.Adapter<ContactAdapter.ContactAdapterHolder>() {


    val objectList = mutableListOf<ContactItemModel>()

    lateinit var contactAdapterInterface: ContactAdapterInterface

    fun setData(data: MutableList<ContactItemModel>) {
        this.objectList.clear()
        this.objectList.addAll(data)
        notifyDataSetChanged()
    }

    fun setInterface(contaa : ContactAdapterInterface){
        this.contactAdapterInterface=contaa
    }



    inner class ContactAdapterHolder(view: View) : RecyclerView.ViewHolder(view) {
        val vbind = ItemContactBinding.bind(view)

        fun bind(model: ContactItemModel) {

            vbind.apply {
                this.labelName.text = model.name
            }

            vbind.root.setOnClickListener {
                contactAdapterInterface.onclick(model)
            }

            Log.d("photoz","${Endpoint.REAL_URL}${model.photoPath}")
            Glide
                .with(vbind.root)
                .load("${Endpoint.REAL_URL}${model.photoPath}")
                .skipMemoryCache(true)
                .dontAnimate()
                .centerCrop()
                .thumbnail(Glide.with(vbind.root).load(R.raw.loading2))
                .placeholder(R.drawable.ic_loading_small_1)
                .into(vbind.ivCover)

        }
    }

    override fun getItemCount(): Int {
        return this.objectList.size
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ContactAdapterHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_contact, parent, false)
        return ContactAdapterHolder(view)
    }


    override fun onBindViewHolder(holder: ContactAdapterHolder, position: Int) {
        holder.bind(objectList[position])
    }

    interface ContactAdapterInterface{
        fun onclick(model:ContactItemModel)
    }


}